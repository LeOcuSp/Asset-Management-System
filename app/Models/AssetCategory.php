<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'asset_item_id'
    ];

    public function parent()
    {
        return $this->belongsTo(AssetCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(AssetCategory::class, 'parent_id');
    }
}
