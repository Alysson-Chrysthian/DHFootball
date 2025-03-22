<?php

namespace App\Livewire\Trait;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

trait WithUserInfoUpdate 
{
    public function updateName($user)
    {
        $user->update([
            'name' => $this->name,
        ]);
    }

    public function updateVideo($user)
    {
        $video = $this->video->store(path: 'videos');
        $thumbnail = 'thumbnails/' . md5(time() . $this->video->getClientOriginalName() . $user->id) . '.png';

        if ($user->video)
            Storage::disk('local')->delete($user->video);

        FFMpeg::fromDisk('local')
            ->open($video)
            ->getFrameFromSeconds(0.1)
            ->export()
            ->toDisk('local')
            ->save($thumbnail);

        if ($user->thumbnail)
            Storage::disk('local')->delete($user->thumbnail);

        $user->update([
            'video' => $video,
            'thumbnail' => $thumbnail,
        ]);
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

        $this->dispatch('avatar-updated');
    }
}