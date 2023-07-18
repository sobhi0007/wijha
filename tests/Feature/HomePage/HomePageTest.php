<?php

namespace Tests\Feature\HomePage;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_Enter_homepage_successfully()
    {
        $response = $this->get('/');
        $response->assertSee('اماكن مميزه للاقامه');
        $response->assertStatus(200);
    }

}
