<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'community_members');
    }
}
