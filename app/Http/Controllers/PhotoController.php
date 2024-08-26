<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Models\Photo;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Photo::paginate());
    }


    public function store(PhotoRequest $request)
    {
        $file = $request->file('photo');
        $path = $file->store('uploads', 'public');
        $fullUrl = Storage::url($path);


        $photo = new Photo([
            'user_id' => auth()->user()->id,
            'photo_url' => $fullUrl,
            'name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'description' => $request->description
        ]);

        $photo->save();
        return response()->json($photo, Response::HTTP_CREATED);
    }


    public function show(string $id)
    {
        $photo = Photo::with('user')->where('id', $id)->firstOrFail();
        return response()->json($photo);
    }


    public function destroy(string $id)
    {
        $photo = Photo::where('id', $id)->firstOrFail();

        if ($photo->user->id != auth()->user()->id) {
            throw new AuthorizationException('You do not have permission to delete this image.');
        }

        $photo->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
