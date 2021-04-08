<?php

namespace App\Http\Livewire;

use App\Exceptions\AlertableException;
use Exception;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class BetterComponent extends Component
{
    protected function success($title, $message)
    {
        $this->sendAlert($title, $message);
    }

    protected function warning($title, $message)
    {
        $this->sendAlert($title, $message, 'warning');
    }

    protected function inform($title, $message)
    {
        $this->sendAlert($title, $message, 'info');
    }

    protected function sendAlert($title, $message, $type = 'success')
    {
        $this->emit('alert', $title, $message, $type);
    }

    public function callMethod($method, $params = [])
    {
        try {
            parent::callMethod($method, $params);
        } catch (AlertableException $exception) {
            $this->warning('Error', $exception->getMessage());
        }
//        catch (ValidationException $exception) {
//            $this->warning('Error', $exception->getMessage());
//        }
//        catch (Exception $exception) {
//            $this->warning('Error', 'Looks like we had a T1 incident.');
//        }
    }
}
