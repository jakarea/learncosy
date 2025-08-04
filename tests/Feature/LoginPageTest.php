<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_login_page_returns_a_successful_response()
    {
        $response = $this->from('http://test.learncosy.com')->get('http://test.learncosy.com/login');

        $response->assertStatus(200);
    }
}
