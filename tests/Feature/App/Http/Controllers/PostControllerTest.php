<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostControllerTest extends TestCase
{
    public function test_posts_succesful_creation()
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
        $payload = [
            "title" => "Johnson&Johnson",
            "description" => "allareas",
        ];
        $response = $this->json("POST", "/api/posts", $payload, $headers);
        $this->assertDatabaseHas("posts", $payload);
        $response->assertStatus(200);
    }
    public function test_posts_duplicacy()
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
        $payload = [
            "title" => "samsung",
            "description" => "mobile",
        ];
        $response = $this->json("POST", "/api/posts", $payload, $headers);
        $this->assertDatabaseHas("posts", $payload);
        $response->assertStatus(500);
    }
    public function test_posts_are_updated_correctly()
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
        $post = Post::where("title", "Lorem")->first();
        $payload = [
            "title" => "Nokia",
            "description" => "Television",
        ];
        $response = $this->json(
            "PUT",
            "/api/posts/" . $post->id,
            $payload,
            $headers
        )->assertStatus(200);
    }
    public function test_posts_are_deleted_correctly()
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
        $post = Post::orderBy("created_at", "desc")->first();
        $this->json("DELETE", "/api/posts/" . $post->id, [], $headers);
        $this->assertDatabaseMissing("posts", $post->toArray());
    }
    public function test_posts_are_fetched_correctly()
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
        $response = $this->json("GET", "/api/posts", [], $headers);
        $response->assertJsonCount(10, "data");
        $response->assertJsonStructure([
            "data" => [
                "*" => [
                    "id",
                    "user_id",
                    "title",
                    "description",
                    "created_at",
                    "updated_at",
                ],
            ],
        ]);
    }
    public function test_authorization_for_posting()
    {
        $payload = [
            "body" => "lorem vscode",
        ];
        $response = $this->json("POST", "/api/posts", $payload);
        $response->assertUnauthorized();
    }
    public function test_posts_listing_without_authorisation()
    {
        $response = $this->json(
            "GET",
            "/api/posts/4/comments",
            []
        )->assertStatus(200);
    }
}
