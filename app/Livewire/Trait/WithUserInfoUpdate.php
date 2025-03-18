<?php

namespace App\Livewire\Trait;

use App\Enums\Role;
use App\Models\UpdateEmailToken;
use App\Notifications\Profile\UpdatePlayerEmail;
use App\Notifications\Profile\UpdateScoutEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $notification = null;
        $token = Str::random(60);

        UpdateEmailToken::create([
            'old_email' => $user->email,
            'new_email' => $this->email,
            'role' => $role,
            'token' => $token,
        ]);

        if ($role == Role::SCOUT->value)
            $notification = new UpdateScoutEmail($user->id, $token);
        if ($role == Role::PLAYER->value)
            $notification = new UpdatePlayerEmail($user->id, $token);

        Notification::route('mail', $this->email)->notify($notification);

        session()->flash('success', 'Para alterar seu email clique no link de verificação enviado para seu novo email');
    }

    public function updateVideo($user)
    {
        $video = $this->video->store(path: 'videos');
        if ($user->video)
            Storage::disk('local')->delete($user->video);

        $user->update([
            'video' => $video,
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
    }
}