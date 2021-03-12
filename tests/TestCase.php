<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Validation\ValidationException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected $seed = true;

    protected function expectValidationException(string $param, $value, string $model = null)
    {
        $this->expectException(ValidationException::class);
        $model           = $model ?? $this->model;
        $model           = new $model;
        $model->{$param} = $value;
    }
}
