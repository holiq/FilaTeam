<?php

namespace App\Livewire;

use App\Models\Team;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SwitchTeam extends Component
{
    protected $listeners = ['refreshCurrentTeam' => '$refresh'];

    public function render(): View
    {
        return view('livewire.switch-team');
    }

    public function changeTeam(Team $team): void
    {
        auth()->user()->switchTeam($team);

        Notification::make()->title('Switched to '.$team->name)->success()->send();
    }
}
