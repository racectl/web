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
        'newEventName'        => 'required|max:256',
        'availableCarsPreset' => 'nullable|in:accGt3s,accGt4s',
        'weatherPreset'       => 'exists:acc_weather_presets,id'
    ];

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    protected function inputDefaults()
    {
        $this->setInputDefault('weatherPreset', 1);
    }

    public function createNewEvent(CreateAccEventAction $createAccEventAction, AccEventSelectedPresets $presets): void
    {
        $this->validate();

        $presets->availableCars = $this->input('availableCarsPreset');
        $presets->setWeatherFromId($this->input('weatherPreset'));

        $createAccEventAction->execute($this->community, $this->input('newEventName'));
        $this->community->refresh();
    }

    public function render()
    {
        return view('livewire.community-admin.event-management')
            ->layout('components.layout', ['title' => $this->community->name . ' - Events']);
    }
}
