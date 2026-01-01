<x-layout>
    <div class="mx-auto max-w-md mt-20">
        <h1 class="text-3xl font-bold text-center text-white mb-10">Reset Password</h1>

        <x-forms.form method="POST" action="{{ route('password.update') }}">
            
            {{-- Hidden Token Field (Required) --}}
            <input type="hidden" name="token" value="{{ $token }}">

            <x-forms.input label="Email" name="email" type="email" :value="old('email', $email)" required />
            <x-forms.input label="New Password" name="password" type="password" required autocomplete="new-password" />
            <x-forms.input label="Confirm Password" name="password_confirmation" type="password" required />

            <x-forms.button class="w-full mt-6">
                Reset Password
            </x-forms.button>
        </x-forms.form>
    </div>
</x-layout>