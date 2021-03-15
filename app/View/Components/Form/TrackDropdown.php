<?php

namespace App\View\Components\Form;

use App\Models\Track;
use Illuminate\View\Component;

class TrackDropdown extends Component
{
    public $tracks;

    public function __construct()
    {
        $this->tracks = Track::all()->sortBy('name');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.track-dropdown');
    }
}
