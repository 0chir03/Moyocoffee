<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUploadAvatarRequest;
use App\Service\AvatarService;
use Illuminate\Support\Facades\Auth;

class ProfileController
{
    private AvatarService $avatarService;
    public function __construct(AvatarService $avatarService)
    {
        $this->avatarService = $avatarService;
    }
    public function getForm()
    {
        return view('profile.avatar');
    }
    public function uploadAvatar(ProfileUploadAvatarRequest $request)
    {

        $this->avatarService->upload($request->file('avatar'));

        return response()->json([
            'message' => 'Avatar uploaded successfully',
            'path' => Auth::user()->avatar
        ]);
    }
}
