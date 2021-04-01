<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends BaseModel
{
    public $timestamps = false;

    public function scopeAccGt3s($query)
    {
        return $query->whereType('GT3')->whereSim('acc');
    }

    public function scopeAccGt4s($query)
    {
        return $query->whereType('GT4')->whereSim('acc');
    }

    public function scopeAcc($query)
    {
        return $query->whereSim('acc');
    }
}
