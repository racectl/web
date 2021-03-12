<?php

namespace App\MenuBuilder;

use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class MenuBuilder
{
    protected Request $request;

    protected Collection $menuSections;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->menuSections = collect();

        $menu = new MenuSection('Administration', 'terminal');
        $menu->addEntry(
            new MenuEntry('Dev', 'dev')
        );

        $this->menuSections->push($menu);
    }

    public function getSections()
    {
        return $this->menuSections;
    }
}
