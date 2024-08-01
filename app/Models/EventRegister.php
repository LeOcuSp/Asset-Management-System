<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'start', 'end', 'location', 'virtual_link',
        'online_only', 'description', 'slug', 'user_id'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'online_only' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
