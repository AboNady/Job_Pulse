<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Services\VectorService;
use App\Models\Job;

class ChatController extends Controller
{
    /**
     * Define the intents, patterns, and responses in one place.
     */

    private const INTENT_CONFIG = [
        'greeting' => [
            'keywords' => [
                'hello', 'helloo', 'hi', 'hii', 'hey', 'heey', 'greetings', 'sup', 
                'welcome', 'good morning', 'good evening', 'yo', 'hola'
            ],
            'threshold' => 1,
            'response' => "**Hello!** 👋 I am your AI Recruiter.\n\nTry asking:\n- *\"High paying Laravel jobs\"*\n- *\"Remote React roles\"*",
        ],

        'small_talk' => [
            'keywords' => [
                'how are you', 'how r u', 'how you doing', 'what up', 'whats up', 
                'how is it going', 'doing good'
            ],
            'threshold' => 1,
            'response' => "I'm doing great, thanks for asking! 🤖 Ready to help you find your next job.",
        ],

        'gratitude' => [
            'keywords' => [
                'thanks', 'thank', 'thx', 'cool', 'awesome', 'great', 'ok', 'okay', 
                'perfect', 'nice', 'appreciated', 'cheers'
            ],
            'threshold' => 1,
            'response' => "You're very welcome! 🚀 Let me know if you need anything else.",
        ],

        'identity' => [
            'keywords' => [
                'who are you', 'what are you', 'your name', 'are you a bot', 'are you human', 
                'real person', 'who made you', 'developer', 'pixel ai'
            ],
            'threshold' => 1, 
            'response' => "I am **Pixel AI**, a smart recruiting agent built with **Laravel 11** and **Groq**.",
        ],

        'help' => [
            'keywords' => [
                'help', 'support', 'guide', 'stuck', 'error', 'broken', 
                'what can you do', 'features', 'how to use'
            ],
            'threshold' => 1,
            'response' => "Here is what I can do:\n🔹 **Salary Search** (e.g. \"Highest paying PHP jobs\")\n🔹 **Tech Stack Search** (e.g. \"Vue.js remote roles\")\n🔹 **Recent Jobs** (e.g. \"Newest postings\")",
        ],

        'farewell' => [
            'keywords' => ['bye', 'goodbye', 'see ya', 'cya', 'exit', 'quit', 'later'],
            'threshold' => 1,
            'response' => "Good luck with your job search! 👋 Come back soon.",
        ]
    ];
    

    public function __invoke(Request $request, VectorService $vectorService)
    {
        $startTime = microtime(true);
        $request->validate(['question' => 'required|string|max:1000']);
        
        $question = trim($request->input('question'));
        
        // GROQ CONFIGURATION
        $groqKey = config('services.groq.key');
        $groqEndpoint = "https://api.groq.com/openai/v1/chat/completions";
        $model = config('services.groq.model'); 

        // --- LAYER 0: LOCAL FILTER ---
        // We check if we have a match. If yes, we return immediately.
        if ($localMatch = $this->checkLocalIntent($question)) {
            return response()->json([
                'answer'   => $localMatch['answer'],
                'actions'  => $localMatch['actions'],
                'duration' => round(microtime(true) - $startTime, 4)
            ]);
        }

        // --- STEP 1: ASK THE AI ROUTER ---
        
        $routerSystem = <<<EOT
You are a database query router.
Return ONLY valid JSON. No markdown.

Tools:
1. "sql_salary": questions about highest/lowest pay, salary sort.
2. "sql_recent": questions about new, latest, recent jobs.
3. "vector_search": everything else (complex skills, fuzzy descriptions).

Schema:
{
  "tool": "sql_salary" | "sql_recent" | "vector_search",
  "sort": "asc" | "desc",
  "limit": 5,
  "search_term": null | "string"
}

INSTRUCTIONS:
- If user mentions a specific technology or title (e.g. "Laravel", "Manager", "Vue"), put it in "search_term".
- If no specific tech is mentioned, set "search_term": null.
- Extract "limit" if user asks for a number ("top 3"). Default 5.
EOT;

        try {
            $routerResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $groqKey,
                'Content-Type'  => 'application/json',
            ])->post($groqEndpoint, [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => $routerSystem],
                    ['role' => 'user', 'content' => $question]
                ],
                'temperature' => 0 // Strict for JSON
            ]);

            $rawContent = $routerResponse->json()['choices'][0]['message']['content'] ?? '{}';
            
            if (preg_match('/\{.*\}/s', $rawContent, $matches)) {
                $decision = json_decode($matches[0], true);
            } else {
                $decision = [];
            }
            
            $tool = $decision['tool'] ?? 'vector_search';
            $limit = isset($decision['limit']) ? min(max((int)$decision['limit'], 1), 20) : 5;
            $searchTerm = $decision['search_term'] ?? null;

        } catch (\Exception $e) {
            $tool = 'vector_search';
            $limit = 15;
            $searchTerm = null;
        }

        // --- STEP 2: EXECUTE THE CHOSEN TOOL ---

        $context = "";

        if ($tool === 'sql_salary') {
            $direction = ($decision['sort'] ?? 'desc') === 'asc' ? 'asc' : 'desc';
            
            $query = Job::with(['employer', 'tags'])
                ->orderByRaw('CAST(REPLACE(REPLACE(salary, " EGP", ""), ",", "") AS UNSIGNED) ' . $direction);

            if ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%");
            }

            $jobs = $query->take($limit)->get();
                
            $context = "Strict database result for salary sort" . ($searchTerm ? " (Filter: $searchTerm)" : "") . ":\n";
            foreach($jobs as $j) {
                $tags = $j->tags->pluck('name')->implode(', ');
                $context .= "- Role: {$j->title} | Location: {$j->location} |Company: {$j->employer->name} | Pay: {$j->salary} | Tags: [{$tags}]\n";
            }

        } elseif ($tool === 'sql_recent') {
            
            $query = Job::with(['employer', 'tags'])->latest();

            if ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%");
            }

            $jobs = $query->take($limit)->get();
            
            $context = "Strict database result for recent jobs" . ($searchTerm ? " (Filter: $searchTerm)" : "") . ":\n";
            foreach($jobs as $j) {
                $tags = $j->tags->pluck('name')->implode(', ');
                $context .= "- Role: {$j->title} | Location: {$j->location} | Company: {$j->employer->name} | Posted: {$j->created_at->diffForHumans()} | Tags: [{$tags}]\n";
            }

        } else {
            // VECTOR SEARCH
            $matches = $vectorService->search($question);
            $jobIds = array_column($matches, 'id');

            if (count($jobIds) > 0) {
                $jobs = Job::with(['employer', 'tags'])
                    ->whereIn('id', $jobIds)
                    ->take($limit)
                    ->get();

                $context = "Here are the most relevant jobs found:\n\n";
                foreach ($jobs as $job) {
                    $tagString = $job->tags->pluck('name')->implode(', ');
                    $context .= "JOB ID: {$job->id}\nTITLE: {$job->title}\nCOMPANY: {$job->employer->name}\nLOCATION: {$job->location}\nSALARY: {$job->salary}\nTAGS: {$tagString}\nDESCRIPTION: " . Str::limit($job->description, 600) . "\n-----------------------------------\n";
                }
            } else {
                $context = "No relevant jobs found in the database.";
            }
        }

        // --- STEP 3: FINAL AI ANSWER ---
        
        $finalSystem = <<<EOT
        You are Pixel AI, an expert Career Coach.

        RULES:
        1. **Chatting:** If the user asks general questions (e.g., "How are you?", "What is this?"), be friendly, brief, and professional.
        2. **Job Data:** If the user asks about jobs, answer using **ONLY** the "JOB DATA" provided below. Do not make up jobs.
        3. **Empty Data:** If the provided job data is empty or does not answer the specific question, politely say you couldn't find any matching jobs.
        4. **Format:** Use bullet points for job listings.
        EOT;

        $finalUser = "JOB DATA:\n{$context}\n\nUSER QUESTION:\n{$question}";

        try {
            $finalResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $groqKey,
                'Content-Type'  => 'application/json',
            ])->post($groqEndpoint, [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => $finalSystem],
                    ['role' => 'user', 'content' => $finalUser]
                ],
                'temperature' => 0.8
            ]);

            $answer = $finalResponse->json()['choices'][0]['message']['content'] ?? 'Sorry, Groq could not answer.';

        } catch (\Exception $e) {
            $answer = "Connection Error: " . $e->getMessage();
        }
        
        $duration = round(microtime(true) - $startTime, 2);

        return response()->json([
            'answer' => $answer,
            'duration' => $duration,
        ]);
    }

    /**
     * Checks if the user input matches any local intent keywords.
     * Supports both exact phrases ("how are you") and fuzzy words ("latavel").
     */
    private function checkLocalIntent(string $question): ?array
    {
        // 1. Clean the input but KEEP spaces
        $cleanSentence = strtolower(trim($question));
        $cleanSentence = preg_replace('/[^a-z0-9\s]/', '', $cleanSentence);
        
        // 2. Create an array of words for single-word checks
        $userWords = explode(' ', $cleanSentence);

        foreach (self::INTENT_CONFIG as $intent => $config) {
            foreach ($config['keywords'] as $keyword) {
                
                $keyword = strtolower($keyword);

                // --- CASE A: PHRASE MATCHING (e.g. "how are you") ---
                // If the keyword contains a space, we look for it in the whole sentence.
                if (str_contains($keyword, ' ')) {
                    if (str_contains($cleanSentence, $keyword)) {
                        return [
                            'answer' => $config['response'],
                            'actions' => $config['actions'] ?? []
                        ];
                    }
                    // Continue to next keyword, don't run single-word logic on a phrase
                    continue; 
                }

                // --- CASE B: SINGLE WORD MATCHING (e.g. "thanks") ---
                foreach ($userWords as $userWord) {
                    
                    // Skip tiny words like "hi" or "a" to avoid false positives
                    if (strlen($userWord) < 2) continue;

                    // 1. Exact Match
                    if ($userWord === $keyword) {
                        return [
                            'answer' => $config['response'],
                            'actions' => $config['actions'] ?? []
                        ];
                    }

                    // 2. Fuzzy Match (Only for words longer than 3 chars)
                    // This prevents "of" matching "ok"
                    if ($config['threshold'] > 0 && strlen($userWord) > 3) {
                        $distance = levenshtein($userWord, $keyword);
                        if ($distance <= $config['threshold']) {
                            return [
                                'answer' => $config['response'],
                                'actions' => $config['actions'] ?? []
                            ];
                        }
                    }
                }
            }
        }

        return null;
    }
}