<?php

namespace App\MenuBuilder;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class MenuSectionNoSubs
{
    public $title, $icon, $link;

    public $targetString, $active = false;

    public $includeFile = 'layout.menu._section-no-subs';

    public function __construct($title, $icon, $routeName)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->link = route($routeName);
        $this->active = $this->isActive($routeName);
        $this->targetString = Str::kebab($title);
    }

    protected function isActive($routeName)
    {
        $currentRoute = app('Illuminate\Http\Request')->route()->getName();
        return $routeName == $currentRoute;
    }
}
