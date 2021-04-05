<?php


namespace App\CustomCollections;


class RaceEventEntriesCollection extends \Illuminate\Database\Eloquent\Collection
{
    public function users()
    {
        $users = collect();
        foreach ($this->items as $entry) {
            foreach($entry->users as $user) {
                $users->push($user);
            }
        }
        return $users;
    }
}
