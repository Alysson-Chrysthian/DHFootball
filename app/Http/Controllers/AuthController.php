<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Scout;
use App\Models\UpdateEmailToken;
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

    public function updatePlayerEmail($id, $hash)
    {
        $player = Player::find($id);
        $token = UpdateEmailToken::where('token', $hash)->first();
        
        if ($player != null && $token != null && $player->email == $token->old_email) {
            $player->update([
                'email' => $token->new_email,
                'email_verified_at' => now(),
            ]);
            $token->delete();
            session()->flash('success', 'Email alterado com sucesso');
            return redirect()->route('player.profile');
        }

        session()->flash('alert', __('auth.wrong'));
        return redirect()->route('player.profile');
    }

    public function updateScoutEmail($id, $hash)
    {
        $scout = Scout::find($id);
        $token = UpdateEmailToken::where('token', $hash)->first();
        
        if ($scout != null && $token != null && $scout->email == $token->old_email) {
            $scout->update([
                'email' => $token->new_email,
                'email_verified_at' => now(),
            ]);
            $token->delete();
            session()->flash('success', 'Email alterado com sucesso');
            return redirect()->route('scout.profile');
        }

        session()->flash('alert', __('auth.wrong'));
        return redirect()->route('scout.profile');
    }

}
