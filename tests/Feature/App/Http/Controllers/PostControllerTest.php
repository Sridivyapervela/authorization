<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostControllerTest extends TestCase
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
    // public function test_posts_succesful_creation()
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
    //     $response = $this->json("POST", "/api/posts", $payload, $headers);
    //     $response->assertStatus(200);
    // }
    // /** @test */
    // public function posts_are_updated_correctly()
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
    //     $post = Post::where("title", "Lorem")->first();
    //     $payload = [
    //         "title" => "French",
    //         "body" => "Ipsum",
    //     ];
    //     $response = $this->json(
    //         "PUT",
    //         "/api/posts/" . $post->id,
    //         $payload,
    //         $headers
    //     )->assertStatus(200);
    // }
    // /** @test */
    // public function posts_are_deleted_correctly()
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
    //     $post = Post::orderBy("created_at", "desc")->first();
    //     $this->json(
    //         "DELETE",
    //         "/api/posts/" . $post->id,
    //         [],
    //         $headers
    //     )->assertStatus(200);
    // }
    /** @test */
    public function posts_are_listed_correctly()
    {
        $credentials = [
            "email" => "deepthi@gmail.com",
            "password" => "password",
        ];
        if (auth()->attempt($credentials)) {
            $token = auth()
                ->user()
                ->createToken("LaravelAuthorization")->accessToken;
        }
        $headers = ["Authorization" => "Bearer $token"];
        $response = $this->json(
            "GET",
            "/api/posts",
            [],
            $headers
        )->assertStatus(200);
        // ->assertJsonStructure([
        //     "*" => [
        //         "id",
        //         "user_id",
        //         "title",
        //         "description",
        //         "created_at",
        //         "updated_at",
        //     ],
        // ]);
    }
}
