<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // Seed basic Laravolt Indonesia records for testing Step 1
        \DB::table('indonesia_provinces')->insert([
            ['code' => '11', 'name' => 'ACEH'],
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
