<?php

namespace Tests;

use App\Models\AccConfig;
use App\Models\Configs\ACC\AccAssistRules;
use App\Models\Configs\ACC\AccBop;
use App\Models\Configs\ACC\AccEvent;
use App\Models\Configs\ACC\AccEventRules;
use App\Models\Configs\ACC\AccEventSession;
use App\Models\Configs\ACC\AccSettings;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected $seed = true;

    protected function logFirstUserIn(): User
    {
        $user = User::first();
        $this->actingAs($user);
        return $user;
    }

    protected function expectValidationException(string $param, $value, string $model = null)
    {
        $this->expectException(ValidationException::class);
        $model           = $model ?? $this->model;
        $model           = new $model;
        $model->{$param} = $value;
    }

    protected function truncateModel(string $model)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $model::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function fullAccConfigFactory($create = true)
    {
        $factory = AccConfig::factory()
            ->has(AccAssistRules::factory(), 'assistRules')
            ->has(
                AccEvent::factory()->has(
                    AccEventSession::factory()->count(3), 'accEventSessions'
                ),
                'event'
            )
            ->has(AccEventRules::factory(), 'eventRules')
            ->has(AccSettings::factory(), 'settings')
            ->has(AccBop::factory(), 'globalBops');
        return $create
            ? $factory->create()
            : $factory;
    }
}
