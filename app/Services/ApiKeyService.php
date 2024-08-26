<?php

namespace App\Services;

use App\Models\ApiKey;
use Illuminate\Support\Str;

class ApiKeyService
{
    public static function generate($name = null)
    {
        $randomString = Str::random(40);
        $userId = auth()->user()->id;
        $timestamp = now()->timestamp;

        $key = hash('sha256', $randomString . $userId . $timestamp);

        return ApiKey::create([
            'key' => $key,
            'user_id' => $userId,
            // 'name' => $name
        ]);
    }

    public static function validate(string $key)
    {
        return ApiKey::where('key', $key)->where('revoked', false)->where('expires_at', '>', now())->exists();
    }
}
