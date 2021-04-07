<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
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

    public function scopeAccGt3sAndGt4s($query)
    {
        return $query->where('type', 'GT3')->orWhere('type', 'GT4');
    }

    public function scopeAcc($query)
    {
        return $query->whereSim('acc');
    }
}
