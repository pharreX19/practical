<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'key',
        'name',
        'expires_at',
        'revoked',
        'user_id'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
