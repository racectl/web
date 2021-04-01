<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int                id
 * @property string             slug
 * @property string             name
 * @property EloquentCollection members
 * @property EloquentCollection events
 */
class Community extends BaseModel
{
    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
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

    public function adminEventManagementLink(): string
    {
        return route('communityAdmin.EventManagement', $this);
    }
}
