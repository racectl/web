<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Widget extends Component
{
    public string $heading;

    public int $width;

    public function __construct($heading, $width = null)
    {
        $this->heading = $heading;
        $this->width = $width ?? 12;
    }

    public function render()
    {
        return view('components.widget');
    }
}
