<?php


namespace Models\Configs\ACC;


use App\Models\Configs\ACC\AccEventSession;

class AccEventSessionConfigModelTest extends \Tests\TestCase
{
    protected string $model = AccEventSession::class;

    /** @test */
    public function it_validates_hour_of_day_is_between_0_and_23()
    {
        $this->expectValidationException('hourOfDay', 24);
    }

    /** @test */
    public function it_validates_day_of_weekend_is_between_1_and_3()
    {
        $this->expectValidationException('dayOfWeekend', 4);
    }

    /** @test */
    public function it_validates_time_multiplier_is_between_0_and_24()
    {
        $this->expectValidationException('timeMultiplier', 25);
    }

    /** @test */
    public function it_validates_session_type_is_valid()
    {
        $this->expectValidationException('sessionType', 'T');
    }

    /** @test */
    public function it_validates_session_duration_minutes_is_integer()
    {
        $this->expectValidationException('sessionDurationMinutes', 'string');
    }

}
