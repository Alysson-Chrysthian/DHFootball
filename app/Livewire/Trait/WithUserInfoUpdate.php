<?php

namespace App\Livewire\Trait;

use Illuminate\Support\Facades\Storage;

trait WithUserInfoUpdate 
{
    public function updateName($user)
    {
        $user->update([
            'name' => $this->name,
        ]);
    }

    public function updateEmail($user, $role)
    {
        //
    }

    public function updateVideo($user)
    {
        //
    }

    public function updateClub($user)
    {
        $user->update([
            'club_id' => $this->club,
        ]);
    }

    public function updatePosition($user)
    {
        $user->update([
            'position_id' => $this->position,
        ]);
    }

    public function updateAvatar($user)
    {
        $avatar = $this->avatar->store(path: 'avatars');
        if ($user->avatar)
            Storage::disk('local')->delete($user->avatar);

        $user->update([
            'avatar' => $avatar
        ]);
    }
}