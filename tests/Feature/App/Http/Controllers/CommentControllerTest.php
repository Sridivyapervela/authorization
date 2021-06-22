<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;

class CommentControllerTest extends TestCase
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
    // public function test_comments_succesful_creation()
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
    //         "body" => "Lorem Ipsum",
    //     ];
    //     $response = $this->json(
    //         "POST",
    //         "/api/posts/4/comment",
    //         $payload,
    //         $headers
    //     );
    //     $response->assertStatus(200);
    // }
    // public function test_comments_are_updated_correctly()
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
    //     $comment = Comment::where("body", "comment")->first();
    //     $payload = [
    //         "body" => "Laravel",
    //     ];
    //     $response = $this->json(
    //         "PUT",
    //         "/api/posts/4/comment/" . $comment->id,
    //         $payload,
    //         $headers
    //     )->assertStatus(200);
    // }
    // public function test_posts_are_deleted_correctly()
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
    //     $comment = Comment::orderBy("created_at", "desc")->first();
    //     $response = $this->json(
    //         "DELETE",
    //         "/api/posts/4/comment/" . $comment->id,
    //         [],
    //         $headers
    //     );
    //     $response->assertStatus(200);
    // }
    // public function test_comments_are_listed_correctly()
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
    //         "/api/posts/4/comments",
    //         [],
    //         $headers
    //     )->assertStatus(200);
    // }
    // public function test_comments_validation()
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
    //         "body" => "Lorem",
    //     ];
    //     $response = $this->json(
    //         "POST",
    //         "/api/posts/4/comment",
    //         $payload,
    //         $headers
    //     );
    //     $response->assertJsonValidationErrors("body");
    // }
    public function test_authorization_for_comments_posting()
    {
        $payload = [
            "body" => "lorem vscode",
        ];
        $response = $this->json("POST", "/api/posts/4/comment", $payload);
        $response->assertStatus(401);
    }
    public function test_comments_listing_without_authorisation()
    {
        $response = $this->json(
            "GET",
            "/api/posts/4/comments",
            []
        )->assertStatus(200);
    }
}
