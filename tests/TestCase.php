<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        User::create([
            'name' => 'test user',
            'email' => 'mail@test.com',
            'password' => bcrypt('password')
        ]);
        $this->actingAs(User::first());
        $this->withExceptionHandling();
    }
}
