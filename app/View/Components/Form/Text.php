<?php

namespace App\View\Components\Form;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Text extends Component
{
    public string $labeled;
    public string $wireTo;
    public int $width;

    public function __construct($wireTo, $labeled = null, $width = null)
    {
        $this->labeled = $labeled ?? $this->makeTitle($wireTo);
        $this->wireTo  = $wireTo;
        $this->width   = $width ?? 12;
    }

    protected function makeTitle($string): string
    {
        $snake  = Str::snake($string);
        $spaced = str_replace('_', ' ', $snake);
        return Str::title($spaced);
    }

    public function render()
    {
        return view('components.form.text');
    }
}
