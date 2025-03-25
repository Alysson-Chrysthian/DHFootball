<?php

namespace App\Livewire\Page\Scout\Chat;

use App\Enums\Age;
use App\Enums\Role;
use App\Enums\Status;
use App\Models\Position;
use App\Models\ScoutPlayer;
use App\Notifications\Contact\DeleteContact;
use App\Notifications\Contact\RequestChangeStatusToPlayer;
use App\Notifications\Contact\SelectContact;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Contacts extends Component
{
    public $search = '';
    public $selectedStatus = [];
    public $positions, $ages;
    public $positionFilter, $ageFilter;

    public function mount()
    { 
        $this->positions = Position::all();
        $this->ages = Age::cases();
    }

    public function changeStatus($contact)
    {
        $contact = ScoutPlayer::with(['player', 'scout'])->find($contact['id']);

        switch ($this->selectedStatus[$contact->id]) {
            case Status::DELETE->value:
                $this->deleteContact($contact);
                break;
            case Status::SELECTED->value:
                $this->selectContact($contact);
                break;
            case Status::IN_ANALISYS->value:
                $this->inAnilisysContact($contact);
                break;
            default:
                return;
        }
    }

    public function deleteContact($contact) 
    {
        $player = $contact->player;
        $scout = $contact->scout;

        $player->notify(new DeleteContact($player, $scout));
        $contact->delete();
    }

    public function selectContact($contact) 
    {
        $player = $contact->player;
        $scout = $contact->scout;

        $player->notify(new RequestChangeStatusToPlayer($player, $scout, $contact));
        session()->flash('success', 'Solicitação enviada para o jogador, aguarde sua resposta');
        $this->redirect(route('scout.contacts'));
    }

    public function inAnilisysContact($contact)
    {
        $contact->update([
            'status' => Status::IN_ANALISYS->value,
        ]);
    }

    #[Layout('components.layouts.scout')]
    public function render()
    {
        $contacts = ScoutPlayer::select('scout_player.*')
            ->with('player')
            ->join('players', 'players.id', '=', 'scout_player.player_id')
            ->join('positions', 'positions.id', '=', 'players.position_id')
            ->where('scout_player.scout_id', Auth::guard(Role::SCOUT->value)->id())
            ->whereAny([
                'players.name',
                'positions.name',
            ], 'like', '%' . $this->search . '%')
            ->when($this->positionFilter, function (Builder $query) {
                $query->where('players.position_id', $this->positionFilter);
            })
            ->when($this->ageFilter, function (Builder $query) {
                $age = Age::from($this->ageFilter);

                $query->whereBetween('players.birthday', [
                    Carbon::now()->subYears($age->range()[1])->toDateTimeString(),
                    Carbon::now()->subYears($age->range()[0])->toDateTimeString(),
                ]);
            })
            ->get();

        
        foreach ($contacts as $contact)
            $this->selectedStatus[$contact->id] = $contact->status;

        return view('livewire.page.scout.chat.contacts', [
            'contacts' => $contacts,
            'status' => Status::cases(),
        ]);
    }
}
