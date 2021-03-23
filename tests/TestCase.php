<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;
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
}
