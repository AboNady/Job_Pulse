<x-layout>
    <div class="min-h-[60vh] flex flex-col items-center justify-center relative">
        <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px] -z-10 pointer-events-none"></div>

        <div class="w-full max-w-md px-6">
            <div class="relative bg-white/5 border border-white/10 rounded-3xl p-10 backdrop-blur-2xl shadow-2xl">
                
                {{-- Icon --}}
                <div class="flex justify-center mb-8">
                    <div class="w-20 h-20 flex items-center justify-center rounded-2xl bg-blue-500/10 border border-blue-500/20">
                        <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                </div>

                {{-- Header --}}
                <div class="text-center space-y-3 mb-8">
                    <h1 class="text-2xl font-bold text-white tracking-tight">Verify Email Address</h1>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        {{-- FIX: Use Auth::user()->email instead of $user->email --}}
                        We've sent a secure verification link to <strong>{{ Auth::user()->email }}</strong>. <br>
                        Please click it to activate your account.
                    </p>
                </div>

                {{-- Flash Message --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-8 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-start gap-3">
                        <p class="text-sm text-emerald-300">
                            A new verification link has been sent to your email address.
                        </p>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button class="w-full py-3.5 px-6 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold shadow-lg shadow-blue-600/20">
                            Resend Verification Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-sm text-slate-500 hover:text-white transition-colors">
                            Log out
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-layout>