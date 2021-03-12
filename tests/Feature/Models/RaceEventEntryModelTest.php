<?php


namespace Tests\Feature\Models;


use App\Models\RaceEvent;
use App\Models\RaceEventEntry;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class RaceEventEntryModelTest extends \Tests\TestCase
{
    /** @test */
    public function it_has_many_users()
    {
        /** @var RaceEventEntry $event */
        $event = RaceEventEntry::factory()->hasUsers(2)->create()->refresh();

        $this->assertInstanceOf(EloquentCollection::class, $event->users);
        $this->assertCount(2, $event->users);
    }

    /** @test */
    public function it_has_a_driver()
    {
        /** @var RaceEventEntry $event */
        $event = RaceEventEntry::factory()->hasUsers(1)->create()->refresh();

        $this->assertInstanceOf(User::class, $event->driver());
    }

    /** @test */
    public function it_throws_exception_on_driver_method_if_there_is_more_than_one_user()
    {
        /** @var RaceEventEntry $event */
        $event = RaceEventEntry::factory()->hasUsers(2)->create()->refresh();

        $this->expectException(\Exception::class);
        $event->driver();
    }

    /** @test */
    public function it_has_a_team()
    {
        /** @var RaceEventEntry $event */
        $event = RaceEventEntry::factory()->hasUsers(2)->create()->refresh();

        $this->assertInstanceOf(EloquentCollection::class, $event->team());
        $this->assertCount(2, $event->team());
    }

    /** @test */
    public function it_throws_exception_on_team_method_if_there_is_only_one_user()
    {
        /** @var RaceEventEntry $event */
        $event = RaceEventEntry::factory()->hasUsers(1)->create()->refresh();

        $this->expectException(\Exception::class);
        $event->team();
    }

    /**
     * @test
     * Driver Category is currently not done correctly.
     */
    public function it_generates_a_entry_list_json_file_statically()
    {
        //fix to reset ids when running full test suit.
        User::truncate();

        /** @var RaceEvent $event */
        $event = RaceEvent::factory()->create();

        $entryOne = new RaceEventEntry;
        $entryOne->raceNumber = 88;
        $entryOne->overrideDriverInfo = 1;
        $event->entries()->save($entryOne);
        $driver = new User;
        $entryOne->users()->save(
            User::factory([
                'first_name' => 'First',
                'last_name' => 'Driver',
                'steam_id' => '765611xxxxxxxxxx1'
            ])->make()
        );

        $entryTwo = new RaceEventEntry;
        $entryTwo->raceNumber = 114;
        $event->entries()->save($entryTwo);
        $entryTwo->users()->saveMany(collect([
            User::factory([
                'first_name' => 'First',
                'last_name' => 'Driver',
                'steam_id' => '765611xxxxxxxxxx3'
            ])->make(),
            User::factory([
                'first_name' => 'Another',
                'last_name' => 'Person',
                'steam_id' => '765611xxxxxxxxxx4'
            ])->make()
        ]));


        $json = RaceEventEntry::generateEntryListConfig($event);


        $expected = file_get_contents(__DIR__ . '\Configs\ACC\entrylist.json');
        $this->assertEquals($expected, $json);
    }
}
