<?php

namespace App\Services\Components\TextInput;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Livewire\Component;
use App\Models\AssetItem;

class FormComponents
{
    public $asset_item_id;
    public $status = 'Active';

    public function updatedStatus($value)
    {
        $assetItem = AssetItem::find($this->asset_item_id);

        if ($assetItem) {
            if (in_array($value, ['damage', 'stolen', 'lost'])) {
                $assetItem->update(['status' => 'Inactive']);
                $this->status = 'Inactive';
            } else {
                $assetItem->update(['status' => 'Active']);
                $this->status = 'Active';
            }
        }
    }

    public function render()
    {
        return view('livewire.your-component');
    }
}










