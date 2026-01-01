<x-layout>

    <div class="max-w-5xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="mb-12 text-center">
            <h1 class="text-5xl font-thin text-white mb-2 tracking-tight">Create Your Account</h1>
            <p class="text-slate-400 text-lg">Join thousands of professionals and employers</p>
        </div>

        {{-- Registration Form --}}
        <x-forms.form method="POST" action="{{ route('registerp') }}" enctype="multipart/form-data"
                       class="space-y-8 bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm p-8 rounded-2xl border border-slate-700/50 shadow-xl">

            {{-- Personal Information Section --}}
            <div>
                <h2 class="text-lg font-thin text-white mb-6 flex items-center gap-2">
                    Personal Information
                </h2>
                
                <div class="space-y-6">
                    <x-forms.input label="Full Name" name="name" type="text" placeholder="John Doe" required autofocus autocomplete="name" />
                    <x-forms.input label="Email Address" name="email" type="email" placeholder="you@example.com" required autocomplete="username" />
                </div>
            </div>

            {{-- Password Section --}}
            <div>
                <h2 class="text-lg font-thin text-white mb-6 flex items-center gap-2">
                    Set Password
                </h2>

                <div class="space-y-6">
                    <x-forms.input label="Password" name="password" type="password" placeholder="At least 8 characters" required autocomplete="new-password" />
                    <x-forms.input label="Confirm Password" name="password_confirmation" type="password" placeholder="Re-enter your password" required autocomplete="new-password" />
                </div>
            </div>

            <x-forms.divider />

            {{-- Employer Information Section --}}
            <div>
                <h2 class="text-lg font-thin text-white mb-2 flex items-center gap-2">
                    Company Information
                </h2>
                <p class="text-slate-400 text-sm mb-6">Tell us about your company</p>

                <div class="space-y-6">
                    {{-- Two Column Layout --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-forms.input label="Company Name" name="employer_name" type="text" placeholder="Acme Corp" required />
                        <x-forms.input label="Phone Number" name="employer_phone" type="tel" placeholder="+1 (555) 123-4567" required />
                    </div>

                    {{-- Email and Address --}}
                    <x-forms.input label="Company Email" name="employer_email" type="email" placeholder="hello@company.com" required />
                    <x-forms.input label="Company Address" name="employer_address" type="text" placeholder="123 Business St, City" required />

                    {{-- Logo Upload --}}
                    <x-forms.field label="Company Logo" name="employer_logo">
                        <div class="space-y-4">
                            <input type="file" name="employer_logo" id="employer_logo"
                                   accept="image/png, image/jpeg, image/gif"
                                   class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                                          text-slate-100 text-sm
                                          file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                          file:text-sm file:font-thin file:bg-blue-600 file:text-white
                                          file:hover:bg-blue-500 file:cursor-pointer file:transition-colors
                                          focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                                          hover:border-slate-600 transition-colors duration-200"
                                   required>
                            <p class="text-xs text-slate-500">Accepted formats: PNG, JPEG, GIF (Max 2MB)</p>

                            {{-- Logo Preview --}}
                            <div id="logoPreviewContainer" style="display: none;" class="flex flex-col">
                                <p class="text-sm font-thin text-slate-300 mb-3">Logo Preview</p>
                                <div class="relative rounded-lg overflow-hidden border border-blue-500/50 bg-slate-800/50 w-32 h-32 flex items-center justify-center">
                                    <img id="logoPreview" src="" alt="Logo preview" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                    </x-forms.field>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex flex-col gap-4 pt-4">
                <button type="submit" class="w-full px-8 py-3 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 
                         text-white font-thin rounded-xl shadow-lg hover:shadow-xl
                         transition-all duration-200 ease-out active:scale-95
                         focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:ring-offset-2 focus:ring-offset-slate-900 cursor-pointer">
                    Create Account
                </button>

                {{-- Login Link --}}
                <p class="text-center text-slate-400">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-thin transition-colors cursor-pointer">
                        Log In
                    </a>
                </p>
            </div>

        </x-forms.form>

    </div>

    <script>
        const logoInput = document.getElementById('employer_logo');
        const previewContainer = document.getElementById('logoPreviewContainer');
        const logoPreview = document.getElementById('logoPreview');

        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    logoPreview.src = event.target.result;
                    previewContainer.style.display = 'flex';
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    </script>

</x-layout>
