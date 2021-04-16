<?php

namespace App\Exceptions;

class UserNotCommunityMemberException extends AlertableException
{
    protected $message = "You must be a member of this community to register.";
}
