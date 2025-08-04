<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_redirect_response()
    {
        $response = $this->get('http://test.learncosy.com');

        $response->assertStatus(302);
        $response->assertRedirect('http://test.learncosy.com/login');
    }

    public function test_the_login_page_returns_a_successful_response()
    {
        $response = $this->get('http://test.learncosy.com/login');

        $response->assertStatus(200);
    }
}
