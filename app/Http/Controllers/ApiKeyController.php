<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ApiKeyService;

class ApiKeyController extends Controller
{
    public function store()
    {
        $key = ApiKeyService::generate(Str::random(5));
        return response()->json($key, Response::HTTP_CREATED);
    }

    public function revoke($id)
    {
        $apiKey = ApiKey::findOrFail($id);
        $apiKey->revoked = true;
        $apiKey->save();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy($id)
    {
        ApiKey::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
