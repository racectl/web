<?php


namespace App\Attachments;


trait UsesModel
{
    protected string $modelAccessor;

    public function __get($name)
    {
        return $this->{$this->modelAccessor}->{$name};
    }

    public function __call($name, $arguments)
    {
        return $this->{$this->modelAccessor}->$name($arguments);
    }
}
