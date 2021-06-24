<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterControllerTest extends TestCase
{
    // use DatabaseTransactions;
    public function test_succesful_registration()
    {
        $response = $this->post("/api/register", [
            "name" => "sams",
            "email" => "sams@gmail.com",
            "password" => "password",
        ]);
        $response->assertStatus(200);
    }
    public function test_logged_in_after_registration()
    {
        $response = $this->post("/api/register", [
            "name" => "manogyna",
            "email" => "manogyna@gmail.com",
            "password" => "password",
        ]);
        $this->assertTrue(Auth::check());
    }
    public function test_duplicate_email()
    {
        $response = $this->post("/api/register", [
            "name" => "manasa",
            "email" => "manu@gmail.com",
            "password" => "password",
        ]);
        $response->assertStatus(500);
    }
    public function test_name_validation_error()
    {
        $response = $this->post("/api/register", [
            "name" => "ams",
            "email" => "samsun@gmail.com",
            "password" => "password",
        ]);
        $response->assertJsonValidationErrors("name");
    }
    public function test_validation_error()
    {
        $credential = ["name" => "bhavana"];
        $response = $this->post("/api/register", $credential);
        $response->assertOk();
        $response->assertJsonValidationErrors(["email", "password"]);
    }
}
