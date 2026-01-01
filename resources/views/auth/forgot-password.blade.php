<x-layout>
    <div class="mx-auto max-w-md mt-20">
        <h1 class="text-3xl font-bold text-center text-white mb-6">Recover Account</h1>

        <p class="text-center text-slate-400 text-sm mb-10">
            Enter your email address and we will send you a secure link to reset your password.
        </p>

        {{-- Success Message --}}
        @if (session('status'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        <x-forms.form method="POST" action="{{ route('password.email') }}">
            <x-forms.input label="Email" name="email" type="email" required autofocus />

            <x-forms.button class="w-full mt-6">
                Email Password Reset Link
            </x-forms.button>
        </x-forms.form>
    </div>
</x-layout>