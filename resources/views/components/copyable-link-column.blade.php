<!-- resources/views/components/copyable-link-column.blade.php -->
@props(['value'])

<div x-data="{ copied: false }">
    <input type="text" value="{{ $value }}" id="copy_{{ $value }}" class="hidden">
    <button
        @click="navigator.clipboard.writeText('{{ $value }}'); copied = true; setTimeout(() => copied = false, 2000)"
        class="text-blue-600 hover:text-blue-900"
    >
        <x-heroicon-o-clipboard-copy class="w-5 h-5 inline" />
    </button>
    <span x-show="copied" class="text-sm text-green-500">Copied!</span>
</div>
