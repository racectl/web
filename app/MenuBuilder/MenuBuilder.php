<?php

namespace App\MenuBuilder;

use App\Models\Community;
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
        $this->superAdmin();
        $this->communityAdmin();
        $this->user();
    }

    protected function superAdmin()
    {
        $menu = new MenuSection('Administration', 'terminal');
        $menu->addEntry(
            new MenuEntry('Dev', 'dev')
        )->addEntry(
            new MenuEntry('Community Management', 'rcadmin.communityManagement')
        );

        $this->menuSections->push($menu);
    }

    protected function communityAdmin()
    {
        $menu = new MenuSection('Community Admin', 'terminal');
        $community = Community::first();
        $menu->addEntry(
            new MenuEntry(
                'Event Management',
                'communityAdmin.EventManagement',
                ['community' => $community]
            )
        );

        $this->menuSections->push($menu);
    }

    protected function user()
    {

    }

    public function getSections()
    {
        return $this->menuSections;
    }
}
