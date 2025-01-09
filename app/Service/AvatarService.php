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
        // Создает менеджер изображений
        $manager = new ImageManager(new Driver());

        // Читает загруженный файл
        $image = $manager->read($file);

        // Изменяет размер изображения до 256x256 пикселей
        $image->cover(256, 256);

        // Генерирует уникальное имя файла, используя текущее время
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = storage_path('app/public/avatars/' . $filename);

        $image->save($path);

        $user = Auth::user();
        $user->avatar = 'avatars/' . $filename;
        $user->save();
    }
}
