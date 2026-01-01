<x-layout>
  <div class="max-w-4xl mx-auto px-6 py-12 space-y-12">

    {{-- Header --}}
    <div class="mb-12">
      <h1 class="text-5xl font-bold text-white mb-2 tracking-tight">User Settings</h1>
      <p class="text-slate-400 text-lg">Manage your account profile and security preferences</p>
    </div>

    {{-- Success / Error Flash Messages --}}
    @if(session('status'))
      <div x-data="{ show: true }" x-show="show" x-transition
           class="flex items-center justify-between bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl backdrop-blur-sm">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ session('status') }}</span>
        </div>
        <button @click="show = false" class="hover:text-emerald-300 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
      </div>
    @endif

    {{-- Account Info Section --}}
    <section class="bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-8 shadow-xl">
      <div class="flex items-center gap-3 mb-8 border-b border-slate-700/50 pb-6">
        <div class="p-2 bg-blue-500/10 rounded-lg">
            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div>
            <h2 class="text-xl font-bold text-white">Profile Information</h2>
            <p class="text-slate-400 text-sm">Update your account's profile information and email address.</p>
        </div>
      </div>

      <form method="POST" action="{{ route('user.settings.update') }}" class="space-y-6 max-w-2xl">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
          <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Display Name</label>
          <input type="text" name="name" id="name"
                 value="{{ old('name', auth()->user()->name) }}"
                 class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                        text-slate-100 placeholder-slate-500 text-sm
                        focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                        hover:border-slate-600 transition-colors duration-200
                        @error('name') border-red-500/50 focus:border-red-500/50 focus:ring-red-500/20 @enderror" 
                 required>
          @error('name')
            <p class="text-xs text-red-400 mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
            </p>
          @enderror
        </div>

        {{-- Email --}}
        <div>
          <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
          <input type="email" name="email" id="email"
                 value="{{ old('email', auth()->user()->email) }}"
                 class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                        text-slate-100 placeholder-slate-500 text-sm
                        focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                        hover:border-slate-600 transition-colors duration-200
                        @error('email') border-red-500/50 focus:border-red-500/50 focus:ring-red-500/20 @enderror" 
                 required>
          @error('email')
            <p class="text-xs text-red-400 mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
            </p>
          @enderror
        </div>

        <div class="pt-4">
          <button type="submit"
                  class="px-8 py-3 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 
                         text-white fonth-thin rounded-xl shadow-lg hover:shadow-xl
                         transition-all duration-200 ease-out active:scale-95
                         focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:ring-offset-2 focus:ring-offset-slate-900 cursor-pointer">
            Save Changes
          </button>
        </div>
      </form>
    </section>

    {{-- Security Section --}}
    <section class="bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-8 shadow-xl">
      <div class="flex items-center gap-3 mb-8 border-b border-slate-700/50 pb-6">
        <div class="p-2 bg-red-500/10 rounded-lg">
            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        </div>
        <div>
            <h2 class="text-xl font-bold text-white">Security</h2>
            <p class="text-slate-400 text-sm">Ensure your account is using a long, random password to stay secure.</p>
        </div>
      </div>

      <form method="POST" action="{{ route('user.password.update') }}" class="space-y-6 max-w-2xl">
        @csrf
        @method('PUT')

        {{-- Current Password --}}
        <div>
          <label for="current_password" class="block text-sm font-medium text-slate-300 mb-2">Current Password</label>
          <input type="password" name="current_password" id="current_password"
                 class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                        text-slate-100 placeholder-slate-500 text-sm
                        focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                        hover:border-slate-600 transition-colors duration-200
                        @error('current_password') border-red-500/50 focus:border-red-500/50 focus:ring-red-500/20 @enderror" 
                 required>
          @error('current_password')
            <p class="text-xs text-red-400 mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
            </p>
          @enderror
        </div>

        {{-- New Password --}}
        <div>
          <label for="password" class="block text-sm font-medium text-slate-300 mb-2">New Password</label>
          <input type="password" name="password" id="password"
                 class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                        text-slate-100 placeholder-slate-500 text-sm
                        focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                        hover:border-slate-600 transition-colors duration-200
                        @error('password') border-red-500/50 focus:border-red-500/50 focus:ring-red-500/20 @enderror" 
                 required>
          @error('password')
            <p class="text-xs text-red-400 mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $message }}
            </p>
          @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">Confirm Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation"
                 class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                        text-slate-100 placeholder-slate-500 text-sm
                        focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                        hover:border-slate-600 transition-colors duration-200" 
                 required>
        </div>

        <div class="pt-4">
          <button type="submit"
                  class="px-8 py-3 bg-gradient-to-br from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 
                         text-white fonth-thin rounded-xl shadow-lg hover:shadow-xl
                         transition-all duration-200 ease-out active:scale-95
                         focus:outline-none focus:ring-2 focus:ring-red-400/50 focus:ring-offset-2 focus:ring-offset-slate-900 cursor-pointer">
            Update Password
          </button>
        </div>
      </form>
    </section>

  </div>
</x-layout>