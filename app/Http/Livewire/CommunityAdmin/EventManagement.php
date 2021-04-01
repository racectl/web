<?php

namespace App\Http\Livewire\CommunityAdmin;

use App\Actions\CreateAccEvent\AccEventSelectedPresets;
use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Http\Livewire\RuleBasedInputs;
use App\Models\Community;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class EventManagement extends Component
{
    use RuleBasedInputs;

    public $community;

    protected $rules = [
        'newEventName' => 'required|max:256',
        'availableCarsPreset' => 'nullable|in:accGt3s,accGt4s'
    ];

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    public function createNewEvent(CreateAccEventAction $createAccEventAction): void
    {
        $this->validate();

        $presets = App::make(AccEventSelectedPresets::class);
        $presets->availableCars = $this->input('availableCarsPreset');

        $createAccEventAction->execute($this->community, $this->input('newEventName'));
        $this->community->refresh();
    }

    public function render()
    {
        return view('livewire.community-admin.event-management')
            ->layout('components.layout', ['title' => $this->community->name . ' - Events']);
    }
}
