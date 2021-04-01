<?php


namespace App\Exceptions;


class UserAlreadyRegisteredToEventException extends AlertableException
{
    protected $message = "Already Registered.";
}
