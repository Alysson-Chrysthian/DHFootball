<?php

namespace App\Livewire\Page\Scout\Explore;

use App\Enums\Role;
use App\Enums\Status;
use App\Models\Player;
use App\Models\ScoutPlayer;
use App\Notifications\Contact\ChooseContact;
use App\Notifications\Contact\DeleteContact;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Watch extends Component
{
    public $id;
    public $player;

    public function mount()
    {
        $this->player = Player::whereNot('video', null)
            ->where('id', $this->id)
            ->first();
        
        if ($this->player == null) 
            throw new NotFoundHttpException();
    }

    public function selectPlayer()
    {
        $scoutPlayer = ScoutPlayer::where('scout_id', Auth::guard(Role::SCOUT->value)->id())
            ->where('player_id', $this->id)
            ->first();

        if ($scoutPlayer) {
            $player = $scoutPlayer->player;
            $player->notify(new DeleteContact($player, $scoutPlayer->scout));
            $scoutPlayer->delete();
            return;
        }
        
        ScoutPlayer::create([
            'status' => Status::IN_ANALISYS->value,
            'scout_id' => Auth::guard(Role::SCOUT->value)->id(),
            'player_id' => $this->id,
        ]);
    
        $player = Player::find($this->id);
        $scout = Auth::guard(Role::SCOUT->value)->user();

        $player->notify(new ChooseContact($player, $scout));
    }

    #[Layout('components.layouts.scout')]
    public function render()
    {
        $scoutPlayer = ScoutPlayer::where('scout_id', Auth::guard(Role::SCOUT->value)->id())
            ->where('player_id', $this->id)
            ->exists();

        return view('livewire.page.scout.explore.watch', [
            'scout_player_exists' => $scoutPlayer
        ]);
    }
}
