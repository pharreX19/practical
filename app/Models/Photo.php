<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory, HasUlids;


    protected $fillable = [
        'user_id',
        'photo_url',
        'name',
        'description',
        'mime_type'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
