<?php

namespace App\View\Components\Form;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public string $wireTo;

    public string $title;

    public function __construct($name, $labeled = null)
    {
        $this->wireTo = $name;
        $this->title  = $labeled ?? $this->makeTitle($name);
    }

    protected function makeTitle($string)
    {
        $snake = Str::snake($string);
        $spaced = str_replace('_', ' ', $snake);
        return Str::title($spaced);
    }

    public function render()
    {
        return view('components.form.checkbox');
    }
}
