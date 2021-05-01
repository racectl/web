<?php

namespace App\Homeless;

class RaceTime
{
    protected $seconds;
    protected $withHour;
    protected $decimal;

    public function __construct(int $time)
    {
        $time = $time / 1000;
        $timeArray = explode('.', $time);
        $seconds = $timeArray[0];
        $this->decimal = $timeArray[1] ?? 0;

        $this->seconds = date('i:s', $seconds);
        $this->withHour = date('H:i:s', $seconds);
    }

    public function onlySeconds()
    {
        return $this->seconds . '.' . $this->decimal;
    }

    public function withHour()
    {
        return $this->withHour . '.' . $this->decimal;
    }

    public function __toString()
    {
        return $this->onlySeconds();
    }
}
