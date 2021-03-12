<?php

namespace App\MenuBuilder;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class MenuSection
{
    public $title, $icon;

    public $targetString, $active = false;

    public $includeFile = 'layout.menu._section';

    public Collection $entries;

    public function __construct($title, $icon)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->targetString = Str::kebab($title);
        $this->entries = collect();
    }

    public function addEntry(MenuEntry $entry)
    {
        if ($entry->active) {
            $this->active = true;
        }

        $this->entries->push($entry);

        return $this;
    }
}
