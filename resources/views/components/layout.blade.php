
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Pulse</title>
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    {{-- Prevent dropdown flashing on page load --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>


<body class="min-h-screen flex flex-col bg-black text-white font-hanken-grotesk">

    <div class="px-10 flex-1 w-full">

        <nav class="flex justify-between items-center py-4">

            {{-- Left Logo --}}
            <div>
                <a href="{{ route('index') }}">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Logo">
                </a>
            </div>

            {{-- Middle Links --}}
            <div class="space-x-6 font-thin">
                <a href="{{ route('index') }}" class="text-white/85 hover:text-white transition-colors duration-200">Jobs</a>
                <a href="{{ route('careers') }}" class="text-white/85 hover:text-white transition-colors duration-200">Careers</a>
                <a href="{{ route('salaries') }}" class="text-white/85 hover:text-white transition-colors duration-200">Salaries</a>
                <a href="{{ route('companies.index') }}" class="text-white/85 hover:text-white transition-colors duration-200">Companies</a>
            </div>

            {{-- Right Side --}}
            @auth
            <div class="relative" x-data="{ open: false }">

                {{-- Avatar + Name + Caret --}}
                <button @click="open = !open"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 cursor-pointer transition-colors duration-200 focus:outline-none group">

                    {{-- User Logo --}}
                    <img src="{{ Auth::user()->employer && Auth::user()->employer->logo 
                                ? asset('storage/' . Auth::user()->employer->logo) 
                                : Vite::asset('resources/images/default-avatar.png') }}" 
                    alt="User Logo" 
                    class="w-10 h-10 rounded-full object-cover border border-white/20 group-hover:border-white/40 transition-colors">

                    {{-- User Name --}}
                    <div class="text-left hidden sm:block">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/60">{{ Auth::user()->employer ? 'Employer' : 'Seeker' }}</p>
                    </div>

                    {{-- Caret icon --}}
                    <svg :class="open ? 'rotate-180' : ''" 
                         class="w-4 h-4 text-white/70 transition-transform duration-300" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                               d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                {{-- Dropdown --}}
                <div x-cloak 
                     x-show="open" 
                     @click.outside="open = false"
                     
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"

                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     
                     class="absolute right-0 mt-3 w-56 bg-slate-900 border border-slate-700/50 rounded-xl shadow-xl py-2 z-50">

                    {{-- User Info Header --}}
                    <div class="px-4 py-3 border-b border-slate-700/50 mb-2">
                        <p class="text-sm font-semibold text-white">Company: {{ Auth::user()->employer->name }}</p>
                        <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
                    </div>

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-2 text-slate-300 hover:bg-slate-800/50 hover:text-white transition-colors duration-200">
                        
                        {{-- Computer Display Icon --}}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" 
                                   d="M3 4h18v12H3zM8 18h8v2H8z" />
                        </svg>

                        Dashboard
                    </a>

                    {{-- Post Job --}}
                    <a href="{{ route('jobs.create') }}" 
                       class="flex items-center gap-3 px-4 py-2 text-slate-300 hover:bg-slate-800/50 hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" 
                                   d="M12 4v16m8-8H4" />
                        </svg>
                        Post a Job
                    </a>

                    {{-- Divider --}}
                    <div class="border-t border-slate-700/50 my-2"></div>

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full flex items-center gap-3 px-4 py-2 text-slate-300 hover:bg-red-500/10 hover:text-red-400 transition-colors duration-200 cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" 
                                       d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3 h12.75" />
                            </svg>
                            Log Out
                        </button>
                    </form>

                </div>
            </div>
            @endauth

            {{-- Guest --}}
            @guest
                <div class="space-x-6 font-thin">
                    <a href="{{ route('register') }}" class="px-0 py-2 cursor-pointer text-white/85 hover:text-white transition-colors duration-200">Sign Up</a>
                    <a href="{{ route('login') }}" class="px-0 py-2 cursor-pointer text-white/85 hover:text-white transition-colors duration-200">Log In</a>
                </div>
            @endguest

        </nav>

        <main class="mt-10 w-[90%] mx-auto">
            {{ $slot }}
        </main>

    </div>

    <footer class="mt-auto py-4 text-center text-sm text-slate-500">
        © {{ date('Y') }} Designed & Developed by 
        <a href="https://github.com/AboNady" target="_blank" class="text-blue-400 font-medium hover:underline">
            Nady
        </a>. All rights reserved.
    </footer>





{{-- Premium AI Chat Widget --}}
<div
    x-data="chatWidget({
        endpoint: '{{ route('chat.ask') }}',
        csrf: '{{ csrf_token() }}'
    })"
    x-init="init()"
    x-cloak
    class="fixed bottom-6 right-6 z-50 font-sans antialiased">

    
    {{-- Chat Window --}}
    <div x-show="isOpen" 
         x-transition:enter="transition cubic-bezier(0.16, 1, 0.3, 1) duration-500"
         x-transition:enter-start="opacity-0 translate-y-12 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition cubic-bezier(0.16, 1, 0.3, 1) duration-300"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-12 scale-95"
         class="flex flex-col w-[380px] h-[600px] max-h-[80vh] mb-4 bg-slate-900/90 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl shadow-black/50 overflow-hidden ring-1 ring-white/5">
        
        {{-- Header --}}
        <div class="px-5 py-4 border-b border-white/5 bg-gradient-to-r from-indigo-600/20 to-blue-600/20 flex justify-between items-center backdrop-blur-md sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-blue-500 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-slate-900 rounded-full"></span>
                </div>
                <div>
                    <h3 class="text-white font-bold text-base tracking-wide">Pixel AI</h3>
                    <p class="text-indigo-200/60 text-xs font-medium">Always online</p>
                </div>
            </div>
            
            <div class="flex items-center gap-1">
                {{-- Clear Chat Button --}}
                <button @click="clearChat()" title="Clear Chat" class="p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-full transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
                {{-- Close Button --}}
                <button @click="isOpen = false" class="p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-full transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>

        {{-- Messages Container --}}
        <div x-ref="scrollContainer" class="flex-1 overflow-y-auto p-5 space-y-6 scroll-smooth custom-scrollbar relative">
            
            {{-- 1. STATIC WELCOME MESSAGE --}}
            <div class="flex gap-4">
                <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center flex-shrink-0 border border-indigo-500/30">
                    <span class="text-sm">🤖</span>
                </div>
                <div class="space-y-1">
                    <div class="bg-white/5 border border-white/10 p-4 rounded-2xl rounded-tl-sm text-slate-200 text-sm leading-relaxed shadow-sm">
                        <p class="font-semibold text-indigo-400 mb-1">Hello! 👋</p>
                        I'm your career assistant. Ask me about:
                        <ul class="mt-2 space-y-1 text-slate-400 list-disc list-inside text-xs">
                            <li>Salary ranges for roles</li>
                            <li>Top companies hiring</li>
                            <li>Skill requirements</li>
                        </ul>
                    </div>
                    <span class="text-[10px] text-slate-500 ml-1">AI Assistant</span>
                </div>
            </div>

            {{-- 2. DYNAMIC HISTORY --}}
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.type === 'user' ? 'flex justify-end' : 'flex gap-4'">
                    
                    {{-- AI Avatar --}}
                    <template x-if="msg.type === 'ai'">
                        <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center flex-shrink-0 border border-indigo-500/30 mt-1">
                            <span class="text-sm">🤖</span>
                        </div>
                    </template>

                    {{-- Message Bubble --}}
                    <div class="space-y-1 max-w-[85%]">
                        <div :class="msg.type === 'user' 
                            ? 'bg-gradient-to-br from-indigo-600 to-blue-600 text-white rounded-2xl rounded-tr-sm shadow-lg shadow-indigo-500/20' 
                            : 'bg-white/5 border border-white/10 text-slate-200 rounded-2xl rounded-tl-sm shadow-sm'"
                            class="p-3.5 text-sm leading-relaxed break-words">
                            
                            {{-- Markdown Parser Wrapper --}}
                            <div x-html="parseMessage(msg.content)" 
                                :class="msg.type === 'user' ? 'text-white' : 'markdown-body'">
                            </div>
                        </div>
                        
                        {{-- Timestamp/Label --}}
                        <div :class="msg.type === 'user' ? 'text-right mr-1' : 'ml-1'">
                            <span class="text-[10px] text-slate-500" x-text="msg.type === 'user' ? 'You' : 'Pixel AI'"></span>

                            {{-- DURATION DISPLAY (Only for AI) --}}
                            <template x-if="msg.duration">
                                <span class="text-[10px] text-indigo-400/60 ml-1" x-text="'(' + msg.duration + 's)'"></span>
                            </template>
                        </div>
                    </div>
                </div>
            </template>

            {{-- 3. LOADING INDICATOR --}}
            <div x-show="isLoading" class="flex gap-4">
                <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center flex-shrink-0 border border-indigo-500/30">
                    <span class="text-sm">🤖</span>
                </div>
                <div class="bg-white/5 border border-white/10 p-4 rounded-2xl rounded-tl-sm w-16 flex items-center justify-center gap-1">
                    <div class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
                    <div class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
                    <div class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-bounce"></div>
                </div>
            </div>

            {{-- 4. ERROR MESSAGE --}}
            <div x-show="error" class="flex justify-center pt-2">
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-2 rounded-full text-xs flex items-center gap-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span x-text="error"></span>
                </div>
            </div>
        </div>

        {{-- Input Area --}}
        <div class="p-4 bg-slate-900/50 backdrop-blur-md border-t border-white/5">
            <form @submit.prevent="sendMessage" class="relative group">
                <input type="text" 
                       x-model="currentQuestion" 
                       x-ref="inputField"
                       placeholder="Type your question..." 
                       class="w-full bg-slate-800 text-white text-sm rounded-xl pl-4 pr-12 py-3.5 
                              focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:bg-slate-800/80
                              border border-white/10 placeholder-slate-500 transition-all shadow-inner"
                       :disabled="isLoading">
                
                <button type="submit" 
                        :disabled="isLoading || !currentQuestion.trim()"
                        class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg transition-all 
                               disabled:opacity-0 disabled:scale-75 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50">
                    <svg class="w-4 h-4 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </form>
            <div class="text-center mt-2">
                <p class="text-[10px] text-slate-600">AI can make mistakes. Verify important info.</p>
            </div>
        </div>
    </div>

    {{-- Floating Toggle Button --}}
    <button @click="toggleChat()" 
            class="group flex items-center justify-center w-14 h-14 rounded-full bg-indigo-600 shadow-2xl shadow-indigo-500/40 transition-all duration-300 transform hover:scale-105 active:scale-95"
            :class="isOpen ? 'bg-slate-800 rotate-90' : 'bg-gradient-to-r from-indigo-600 to-blue-600'">
        
        <svg x-show="!isOpen" class="w-7 h-7 text-white transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>

        <svg x-show="isOpen" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>

        <span x-show="!isOpen && messages.length > 0" class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-slate-900"></span>
    </button>
</div>

{{-- Styles --}}
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.02); }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }
    [x-cloak] { display: none !important; }
</style>


</body>
</html>

