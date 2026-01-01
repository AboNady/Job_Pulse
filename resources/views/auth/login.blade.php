<x-layout>
    <div class="mx-auto max-w-md mt-20">
        
        {{-- Header --}}
        <h1 class="text-3xl font-medium text-center text-white mb-10">Log In</h1>

        <x-forms.form method="POST" action="{{ route('loginp') }}">

            <x-forms.input label="Email" name="email" type="email" required autocomplete="username" />

            {{-- Fixed: autocomplete="current-password" is better for login forms --}}
            <x-forms.input label="Password" name="password" type="password" required autocomplete="current-password" />

            {{-- Row: Remember Me + Forgot Password --}}
            <div class="flex items-center justify-between mt-6">
                
                {{-- Remember Me Checkbox --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" 
                           name="remember" 
                           id="remember" 
                           class="rounded border-white/10 bg-white/5 text-blue-600 shadow-sm focus:ring-blue-600 focus:ring-offset-gray-900 focus:ring-offset-2 transition">
                    
                    <label for="remember" class="text-sm text-gray-400 hover:text-gray-300 cursor-pointer select-none">
                        Remember Me
                    </label>
                </div>

                {{-- Forgot Password Link (Optional, usually goes here) --}}
                <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:text-blue-300 hover:underline">
                    Forgot Password?
                </a>
            </div>

            <x-forms.button class="w-full mt-8 py-3 cursor-pointer">
                Log In
            </x-forms.button>

        </x-forms.form>
    </div>
</x-layout>
