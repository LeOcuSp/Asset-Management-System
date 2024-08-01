<?php

namespace App\Models;

use Livewire\Component;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'asset_category_id', 'asset_damage_id', 'brand', 'model', 'date_of_purchase',
        'description', 'serial_number', 'asset_number', 'date_of_warranty', 'asset_donor_id',
        'location', 'vendor', 'purchased_price', 'remark', 'status', 'asset_allocation_id'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

     public function assetDamages()
     {
         return $this->hasMany(AssetDamage::class, 'asset_item_id');
     }

    public function donor()
    {
        return $this->belongsTo(AssetDonor::class, 'asset_donor_id');
    }

    public function allocation()
    {
        return $this->hasMany(AssetAllocation::class,'asset_allocation_id');
    }

    public function latestAllocation()
    {
        return $this->hasOne(AssetAllocation::class)->latestOfMany();
    }

    public function getOptionsFormComponents()
    {
        return [];
    }

}

