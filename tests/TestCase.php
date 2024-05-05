<?php

namespace Infinity\Jumpstart\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Infinity\Jumpstart\LaravelJumpstartServiceProvider;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase, WithWorkbench;

    protected function getPackageProviders($app): array
    {
        return [
            LaravelJumpstartServiceProvider::class,
        ];
    }
}
