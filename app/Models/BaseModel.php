<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function rules(): array
    {
        return [];
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->relations) || method_exists($this, $key)) {
            return parent::__get($key);
        } else {
            return parent::__get(Str::snake($key));
        }
    }

    public function __set($key, $value)
    {
        if (array_key_exists($key, static::rules())) {
            Validator::make([$value], [static::rules()[Str::camel($key)]])->validate();
        }
        parent::__set(Str::snake($key), $value);
    }

    public function __isset($key)
    {
        return parent::__isset(Str::snake($key));
    }

    public function __unset($key)
    {
        parent::__unset(Str::snake($key));
    }
}
