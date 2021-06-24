<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("register", [RegisterController::class, "register"]);
Route::post("login", [LoginController::class, "login"]);
Route::get("/posts/{post}/comments", [CommentController::class, "index"]);
Route::get("/posts", [PostController::class, "index"]);
Route::middleware("auth:api")->group(function () {
    Route::resource("posts", PostController::class, [
        "except" => ["index"],
    ]);
    Route::post("/posts/{post}/comment", [CommentController::class, "store"]);
    Route::put("/posts/{post}/comment/{comment}", [
        CommentController::class,
        "update",
    ]);
    Route::delete("/posts/{post}/comment/{comment}", [
        CommentController::class,
        "destroy",
    ]);
});
