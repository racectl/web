<?php

namespace App\Exceptions;

class UserNotCommunityMemberException extends AlertableException
{
    protected $message = "You are not apart of this community.";
}
