<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get("/");

        $response->assertStatus(200);
    }
    /** @test */
    public function test_login_true()
    {
        $credential = [
            "email" => "deepthi@gmail.com",
            "password" => "password",
        ];
        $response = $this->post("/api/login", $credential);
        $response->assertSessionMissing("errors");
        // $response->assertSessionHas([
        //     "email" => "deepthi@gmail.com",
        // ]);
        $response->assertStatus(200);
    }

    // public function testRequiresEmailAndLogin()
    // {
    //     $credential = [];
    //     $response = $this->post("/api/login", $credential);
    //     $response->assertStatus(500);
    // }

    /** @test */
    public function test_password_validation()
    {
        $credential = [
            "email" => "deepthi@gmail.com",
            "password" => "",
        ];
        $response = $this->post("/api/login", $credential);
        $response->assertJsonValidationErrors("password");
    }
    /** @test */
    public function test_login_false()
    {
        $credential = [
            "email" => "deepthi@gmail.com",
            "password" => "password1",
        ];
        $response = $this->post("/api/login", $credential);
        $response->assertStatus(401);
    }
    /** @test */
    function logged_in_after_login()
    {
        $this->assertGuest();
        $user = ["email" => "deepthi@gmail.com", "password" => "password"];
        $response = $this->post("/api/login", [
            "email" => "deepthi@gmail.com",
            "password" => "password",
        ]);
        $this->assertAuthenticated();
        // $this->assertTrue(Auth::check());
        // $this->assertCount(0, User::all());
    }
}
