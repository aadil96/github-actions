<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    private $except = [
        'sanctum',
        'outh',
        'passport',
        'telescope',
    ];

    public function test_all_get_routes_return_200_as_status_code()
    {
        $routeCollection = Route::getRoutes();
        if (false) {
            echo 'Hi';
        }

        foreach ($routeCollection as $value) {
            if (!Str::contains($value->uri(), $this->except) && $value->methods()[0] === 'GET') {
                $response = $this->call($value->methods()[0], $value->uri());
                $response->assertOk();
            }
        }
    }

    public function test_all_post_routes_return_200_as_status_code()
    {
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $value) {
            if (!Str::contains($value->uri(), 'sanctum') && $value->methods()[0] === 'POST') {
                $response = $this->call($value->methods()[0], $value->uri());
                $response->assertOk();
            }
        }
    }
}
