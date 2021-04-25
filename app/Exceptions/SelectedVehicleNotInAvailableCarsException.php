<?php

namespace App\Exceptions;

class SelectedVehicleNotInAvailableCarsException extends AlertableException
{
    protected $message = 'Invalid Car Selection';
}
