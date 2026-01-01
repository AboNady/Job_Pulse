
{{-- field.blade.php --}}
@props(['label', 'name'])

<div>
    @if ($label)
        <x-forms.label :$name :$label />
    @endif

    <div class="mt-3">
        {{ $slot }}

        <x-forms.error :error="$errors->first($name)" />
    </div>
</div>
