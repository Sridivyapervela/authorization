<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterControllerTest extends TestCase
{
    // use DatabaseTransactions;
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

    // /** @test */
    // function succesful_registration()
    // {
    //     $response = $this->post("/api/register", [
    //         "name" => "sams",
    //         "email" => "sams@gmail.com",
    //         "password" => "password",
    //     ]);
    //     $response->assertStatus(200);
    // }

    // /** @test */
    // function logged_in_after_registration()
    // {
    //     $response = $this->post("/api/register", [
    //         "name" => "manogyna",
    //         "email" => "manogyna@gmail.com",
    //         "password" => "password",
    //     ]);
    //     $this->assertTrue(Auth::check());
    // }

    // /** @test */
    // function duplicate_email()
    // {
    //     $response = $this->post("/api/register", [
    //         "name" => "manasa",
    //         "email" => "manu@gmail.com",
    //         "password" => "password",
    //     ]);
    //     $response->assertStatus(500);
    // }

    // /** @test */
    // function name_validation_error()
    // {
    //     $response = $this->post("/api/register", [
    //         "name" => "ams",
    //         "email" => "samsun@gmail.com",
    //         "password" => "password",
    //     ]);
    //     $response->assertJsonValidationErrors("name");
    // }

    /** @test */
    function validation_error()
    {
        $credential = ["name" => "bhavana"];
        $response = $this->post("/api/register", $credential);
        $response->assertOk();
        $response->assertJsonValidationErrors(["email", "password"]);
    }
}
