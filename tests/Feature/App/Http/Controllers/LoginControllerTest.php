<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class LoginControllerTest extends TestCase
{
    public function test_login_true()
    {
        $credential = [
            "email" => "deepthi@gmail.com",
            "password" => "password",
        ];
        $response = $this->post("/api/login", $credential);
        $response->assertSessionMissing("errors");
        $response->assertStatus(200);
    }
    public function testRequiresEmailAndLogin()
    {
        $credential = [];
        $response = $this->post("/api/login", $credential);
        $response->assertJsonMissingValidationErrors("email", "password");
    }
    public function test_password_validation()
    {
        $credential = [
            "email" => "deepthi@gmail.com",
            "password" => "",
        ];
        $response = $this->post("/api/login", $credential);
        $response->assertJsonValidationErrors("password");
    }
    public function test_login_false()
    {
        $credential = [
            "email" => "deepthi@gmail.com",
            "password" => "password1",
        ];
        $response = $this->post("/api/login", $credential);
        $response->assertStatus(401);
    }
    public function test_logged_in_after_login()
    {
        $this->assertGuest();
        $user = ["email" => "deepthi@gmail.com", "password" => "password"];
        $response = $this->post("/api/login", [
            "email" => "deepthi@gmail.com",
            "password" => "password",
        ]);
        $this->assertAuthenticated();
        $this->assertTrue(Auth::check());
        $this->assertCount(9, User::all());
    }
}
