<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class UserControllerTest extends TestCase
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
    // /** @test */
    // public function test_users_succesful_creation()
    // {
    //     $credentials = [
    //         "email" => "deepthi@gmail.com",
    //         "password" => "password",
    //     ];
    //     if (auth()->attempt($credentials)) {
    //         $token = auth()
    //             ->user()
    //             ->createToken("LaravelAuthorization")->accessToken;
    //     }
    //     $headers = ["Authorization" => "Bearer $token"];
    //     $payload = [
    //         "title" => "Lorem",
    //         "description" => "Ipsum",
    //     ];
    //     $response = $this->json("POST", "/api/users", $payload, $headers);
    //     $response->assertStatus(200);
    // }
    // /** @test */
    // public function users_are_updated_correctly()
    // {
    //     $credentials = [
    //         "email" => "deepthi@gmail.com",
    //         "password" => "password",
    //     ];
    //     if (auth()->attempt($credentials)) {
    //         $token = auth()
    //             ->user()
    //             ->createToken("LaravelAuthorization")->accessToken;
    //     }
    //     $headers = ["Authorization" => "Bearer $token"];
    //     $user = user::where("title", "Lorem")->first();
    //     $payload = [
    //         "title" => "French",
    //         "body" => "Ipsum",
    //     ];
    //     $response = $this->json(
    //         "PUT",
    //         "/api/users/" . $user->id,
    //         $payload,
    //         $headers
    //     )->assertStatus(200);
    // }
    // /** @test */
    // public function users_are_deleted_correctly()
    // {
    //     $credentials = [
    //         "email" => "deepthi@gmail.com",
    //         "password" => "password",
    //     ];
    //     if (auth()->attempt($credentials)) {
    //         $token = auth()
    //             ->user()
    //             ->createToken("LaravelAuthorization")->accessToken;
    //     }
    //     $headers = ["Authorization" => "Bearer $token"];
    //     $user = user::orderBy("created_at", "desc")->first();
    //     $this->json(
    //         "DELETE",
    //         "/api/users/" . $user->id,
    //         [],
    //         $headers
    //     )->assertStatus(200);
    // }
    // /** @test */
    // public function users_are_listed_correctly()
    // {
    //     $credentials = [
    //         "email" => "deepthi@gmail.com",
    //         "password" => "password",
    //     ];
    //     if (auth()->attempt($credentials)) {
    //         $token = auth()
    //             ->user()
    //             ->createToken("LaravelAuthorization")->accessToken;
    //     }
    //     $headers = ["Authorization" => "Bearer $token"];
    //     $response = $this->json(
    //         "GET",
    //         "/api/users",
    //         [],
    //         $headers
    //     )->assertStatus(200);
    //     // ->assertJsonStructure([
    //     //     "*" => [
    //     //         "id",
    //     //         "user_id",
    //     //         "title",
    //     //         "description",
    //     //         "created_at",
    //     //         "updated_at",
    //     //     ],
    //     // ]);
    // }
}
