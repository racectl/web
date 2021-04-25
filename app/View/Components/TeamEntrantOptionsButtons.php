<?php

namespace App\View\Components;

use App\Models\RaceEventEntry;
use Illuminate\View\Component;

class TeamEntrantOptionsButtons extends Component
{
    public RaceEventEntry $authEntry;
    public bool           $showLeaveTeam;
    public int            $width;

    public function __construct(RaceEventEntry $authEntry)
    {
        $this->authEntry     = $authEntry;
        $this->showLeaveTeam = ($authEntry->users->count() > 1);
        $this->width = $this->showLeaveTeam
            ? 6
            : 12;
    }

    public function render()
    {
        return view('components.team-entrant-options-buttons');
    }
}
