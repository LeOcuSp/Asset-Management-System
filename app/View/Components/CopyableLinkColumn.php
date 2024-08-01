<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CopyableLinkColumn extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.copyable-link-column');
    }
}

// <!-- resources/views/components/copyable-link-column.blade.php -->
// @props(['value'])

// <div x-data="{ copied: false }">
//     <input type="text" value="{{ $value }}" id="copy_{{ $value }}" class="hidden">
//     <button
//         @click="navigator.clipboard.writeText('{{ $value }}'); copied = true; setTimeout(() => copied = false, 2000)"
//         class="text-blue-600 hover:text-blue-900"
//     >
//         <x-heroicon-o-clipboard-copy class="w-5 h-5 inline" />
//     </button>
//     <span x-show="copied" class="text-sm text-green-500">Copied!</span>
// </div>
