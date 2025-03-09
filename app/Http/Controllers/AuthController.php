<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Scout;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function verifyPlayer($id, $hash)
    {
        $player = Player::find($id);

        if ($player && !$player->hasVerifiedEmaiL() && sha1($player->email) == $hash) {
            $player->markEmailAsVerified();
            return redirect()->route('player.profile');
        }

        return redirect()->route('auth.player.login')
            ->with([
                'alert' => __('auth.wrong'),
            ]);
    }

    public function verifyScout($id, $hash)
    {
        $scout = Scout::find($id);

        if ($scout && !$scout->hasVerifiedEmaiL() && sha1($scout->email) == $hash) {
            $scout->markEmailAsVerified();
            return redirect()->route('scout.profile');
        }

        return redirect()->route('auth.scout.login')
            ->with([
                'alert' => __('auth.wrong'),
            ]);
    }

}
