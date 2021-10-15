<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
		$this->actingAs(User::first());
        $routeCollection = FacadesRoute::getRoutes();
        foreach ($routeCollection as $value ) {
            if (!Str::contains($value->uri(), 'sanctum')) {
                $response = $this->call($value->methods()[0], $value->uri());
                dump($value->uri());
                $response->assertOk();
            }
        }
    }
}
