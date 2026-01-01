<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VectorService
{
    protected $geminiKey;
    protected $pineconeKey;
    protected $pineconeHost;

    public function __construct()
    {
        $this->geminiKey = config('services.gemini.key');
        $this->pineconeKey  = config('services.pinecone.api_key');
        $this->pineconeHost = config('services.pinecone.host');
    }

    /**
     * Step 1: Turn Text into Numbers (Vector)
     * NOTE: Groq does not support embeddings. We must use Google/OpenAI/HuggingFace here.
     */
    public function getEmbedding(string $text): array
    {
        // Using Google's embedding model
        $url = "https://generativelanguage.googleapis.com/v1beta/models/text-embedding-004:embedContent?key={$this->geminiKey}";

        $response = Http::timeout(30)
            ->retry(3, 1000) 
            ->withoutVerifying()
            ->post($url, [
                'content' => [
                    'parts' => [
                        ['text' => $text]
                    ]
                ]
            ]);

        if ($response->failed()) {
            Log::error('Vector Embedding Failed', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);
            return [];
        }

        return $response->json()['embedding']['values'] ?? [];
    }

    /**
     * Step 2: Save to Pinecone
     */
    public function upsertJob($job)
    {
        $textToEmbed = "Job Title: {$job->title}. Description: {$job->description}. Location: {$job->location}.";
        $vector = $this->getEmbedding($textToEmbed);

        if (empty($vector)) return;

        $url = "{$this->pineconeHost}/vectors/upsert";
        
        $response = Http::withHeaders([
            'Api-Key' => $this->pineconeKey,
            'Content-Type' => 'application/json',
        ])
        ->timeout(60)
        ->retry(3, 1000)
        ->withoutVerifying()
        ->post($url, [
            'vectors' => [
                [
                    'id' => (string) $job->id,
                    'values' => $vector,
                    'metadata' => [
                        'title' => $job->title,
                        'salary' => $job->salary,
                        'company' => $job->employer->name ?? 'Unknown',
                        'location' => $job->location,
                        'type' => $job->type
                    ]
                ]
            ]
        ]);

        if ($response->failed()) {
            Log::error('Pinecone Upsert Failed', $response->json());
        }
    }

    /**
     * Step 3: Search Pinecone
     */
    public function search(string $userQuestion): array
    {
        $queryVector = $this->getEmbedding($userQuestion);

        if (empty($queryVector)) return [];

        $url = "{$this->pineconeHost}/query";

        $response = Http::withHeaders([
            'Api-Key' => $this->pineconeKey,
            'Content-Type' => 'application/json',
        ])
        ->timeout(60)
        ->retry(2, 500)
        ->withoutVerifying()
        ->post($url, [
            'vector' => $queryVector,
            'topK' => 15,
            'includeMetadata' => true
        ]);

        return $response->json()['matches'] ?? [];
    }

    /**
     * Batch Upsert
     */
    public function upsertBatch($jobs)
    {
        $vectors = [];

        foreach ($jobs as $job) {
            $text = "Job Title: {$job->title}. Description: " . \Illuminate\Support\Str::limit($job->description, 500) . ". Location: {$job->location}.";
            $vector = $this->getEmbedding($text);

            if (!empty($vector)) {
                $vectors[] = [
                    'id' => (string) $job->id,
                    'values' => $vector,
                    'metadata' => [
                        'title' => $job->title,
                        'salary' => $job->salary,
                        'company' => $job->employer->name ?? 'Unknown',
                        'location' => $job->location,
                        'type' => $job->type
                    ]
                ];
            }
            usleep(200000); 
        }

        if (empty($vectors)) return;

        $url = "{$this->pineconeHost}/vectors/upsert";
        
        Http::withHeaders([
            'Api-Key' => $this->pineconeKey,
            'Content-Type' => 'application/json',
        ])
        ->timeout(120)
        ->retry(3, 1000)
        ->withoutVerifying()
        ->post($url, [
            'vectors' => $vectors
        ]);
    }
}