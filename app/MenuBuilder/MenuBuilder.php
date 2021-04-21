<?php

namespace App\MenuBuilder;

use App\Models\Community;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class MenuBuilder
{
    protected Request $request;

    protected Collection $menuSections;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->menuSections = collect();

        if (Auth::guest()) {
            $this->guests();
        }

        $this->superAdmin();
        $this->communityAdmin();
        $this->user();

        if (App::environment('local')) {
            $this->testingLogins();
        }
    }

    protected function testingLogins()
    {
        $menu = new MenuSection('Testing Logins', 'terminal');

        foreach (User::all() as $user) {
            $menu->addEntry(
                new MenuEntry($user->displayName, 'dev.login', $user)
            );
        }

        $this->menuSections->push($menu);
    }

    protected function guests()
    {

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
                'communityAdmin.eventManagement',
                ['community' => $community]
            )
        );

        $this->menuSections->push($menu);
    }

    protected function user()
    {
        $menu = new MenuSection('Users', 'terminal');
        $community = Community::first();
        $menu->addEntry(
            new MenuEntry(
                'Community Event Page',
                'community.events',
                ['community' => $community]
            )
        );

        $this->menuSections->push($menu);
    }

    public function getSections()
    {
        return $this->menuSections;
    }
}
