<?php

namespace App\Service;

use App\Http\Requests\ProfileUploadAvatarRequest;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AvatarService
{
    public function upload($file)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover(256, 256);

        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = storage_path('app/public/avatars/' . $filename);
        $image->save($path);

        $user = Auth::user();
        $user->avatar = 'avatars/' . $filename;
        $user->save();
    }
}
