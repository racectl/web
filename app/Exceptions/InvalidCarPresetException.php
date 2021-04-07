<?php


namespace App\Exceptions;


class InvalidCarPresetException extends AlertableException
{
    protected $message = 'Invalid Car Preset.';
}
