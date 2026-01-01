
{{-- error.blade.php --}}
@props(['error' => false])

@if ($error)
    <div class="flex items-center gap-2 mt-2 p-3 bg-red-500/10 border border-red-500/30 rounded-lg">
        <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
        </svg>
        <p class="text-sm text-red-400">{{ $error }}</p>
    </div>
@endif