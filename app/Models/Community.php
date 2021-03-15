<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 */
class Community extends BaseModel
{
    public static function rules(): array
    {
        return [
            'name' => 'required'
        ];
    }

    public function events(): HasMany
    {
        return $this->hasMany(RaceEvent::class);
    }
}
