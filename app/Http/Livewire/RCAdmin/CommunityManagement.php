<?php

namespace App\Http\Livewire\RCAdmin;

use App\Http\Livewire\RuleBasedInputs;
use App\Models\Community;
use Illuminate\Support\Str;
use Livewire\Component;

class CommunityManagement extends Component
{
    use RuleBasedInputs;

    protected $rules = [
        'newCommunityName' => 'required|max:256|string'
    ];

    public function createNewCommunity()
    {
        $this->validate();

        $community = new Community;
        $community->name = $this->input('newCommunityName');
        $community->slug = Str::slug($this->input('newCommunityName'));
        $community->save();
    }

    public function render()
    {
        return view('livewire.r-c-admin.community-management')
            ->layout('components.layout', ['title' => 'Community Management'])
            ->with([
                'communities' => Community::all()
            ]);
    }
}
