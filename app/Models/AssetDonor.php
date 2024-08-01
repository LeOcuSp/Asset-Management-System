<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDonor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'asset_item_id',
    ];

    public function assetItems()
    {
        return $this->hasMany(AssetItem::class, 'asset_donor_id');
    }
}
