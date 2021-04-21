<?php

namespace App\Http\Livewire\CommunityAdmin\EventManagement;

use App\Http\Livewire\RuleBasedInputs;
use App\Models\Configs\ACC\AccEventSession;
use Livewire\Component;

class IndividualAccEventSession extends Component
{
    use RuleBasedInputs;

    public AccEventSession $session;
    public bool            $modelIsDirty = false;

    protected $rules;

    public function __construct($id = null)
    {
        $this->rules = AccEventSession::rules();
        parent::__construct($id);
    }

    protected function setDefaults()
    {
        foreach ($this->rules as $property => $null) {
            $this->setInputDefault($property, $this->session->$property);
        }
    }

    public function updated()
    {
        $this->syncSessionModelAttributesToInputs();
    }

    protected function syncSessionModelAttributesToInputs()
    {
        foreach ($this->rules as $property => $null) {
            $this->session->$property = $this->input($property);
        }
        $this->modelIsDirty = $this->session->isDirty();
    }

    public function save()
    {
        $this->syncSessionModelAttributesToInputs();
        $this->session->save();
        $this->modelIsDirty = false;
    }

    public function delete()
    {
        $this->session->delete();
        $this->emit('refreshSessions');
    }

    public function render()
    {
        return view('livewire.community-admin.event-management.individual-acc-event-session');
    }
}
