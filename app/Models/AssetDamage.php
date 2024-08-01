<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDamage extends Model
{
    use HasFactory;

protected $fillable = [
    'date',
    'asset_item_id',
    'asset_category_id', // added
    'reason',
    'status',
    'reported_by',
    'location_of_damage',
    'remark'
];
public function assetItem()
{
    return $this->belongsTo(AssetItem::class, 'asset_item_id');
}

public function category()
{
    return $this->belongsTo(AssetCategory::class, 'asset_category_id');
}

protected static function boot()
{
    parent::boot();

    static::deleting(function ($assetDamage) {
        $assetItem = \App\Models\AssetItem::find($assetDamage->asset_item_id);
        if ($assetItem) {
            // Check if there are no other damage records for this asset item
            $otherDamageRecords = AssetDamage::where('asset_item_id', $assetDamage->asset_item_id)->where('id', '!=', $assetDamage->id)->exists();
            if (!$otherDamageRecords) {
                $assetItem->update(['status' => 'Active']);
            }
        }
    });
}
}
