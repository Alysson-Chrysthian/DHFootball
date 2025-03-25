<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Scout;
use App\Models\ScoutPlayer;
use App\Notifications\Contact\PlayerAcceptYourRequest;
use App\Notifications\Contact\PlayerSelectedByOtherScout;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function changePlayerStatusToSelected($id, $hash)
    {
        $contact = ScoutPlayer::with(['player', 'scout'])->find($id);

        if (sha1($contact->player->email) != $hash)
            return redirect()->route('player.profile')
                ->with([
                    'alert' => __('auth.wrong'),
                ]);

        if ($contact->status == Status::SELECTED->value) 
            return redirect()->route('player.profile');

        $scout = Scout::find($contact->scout->id);
        $scout->notify(new PlayerAcceptYourRequest($contact->player));

        $contact->update([
            'status' => Status::SELECTED->value,
        ]);

        $scouts = Scout::select('scouts.*')
            ->join('scout_player', 'scout_player.scout_id', '=', 'scouts.id')
            ->whereNot('scout_player.status', Status::SELECTED->value)
            ->get();

        foreach ($scouts as $scout) 
            $scout->notify(new PlayerSelectedByOtherScout($contact->player, $scout));
    
        ScoutPlayer::where('player_id', $contact->player->id)
            ->whereNot('status', Status::SELECTED->value)
            ->delete();

        return redirect()->route('player.profile')->with([
            'success' => 'Parabens, você esta efetivado como jogador'
        ]);
    }

}
