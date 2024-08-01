<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAllocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'date',
        'allocated_from',
        'allocated_to',
        'asset_item_id',
    ];

    public function assetItem()
    {
        return $this->belongsTo(AssetItem::class, 'asset_item_id');
    }
}
