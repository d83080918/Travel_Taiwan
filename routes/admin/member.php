<?php

use App\Http\Controllers\Itec\Member\MemberController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "member"], function () {
    Route::get("login", [MemberController::class, "login"]);
    Route::post("dologin", [MemberController::class, "dologin"]);
    Route::post("logout", [MemberController::class, "logout"]);
    Route::get("register", [MemberController::class, "register"]);
    Route::post("store", [MemberController::class, "store"]);
    Route::post("update", [MemberController::class, "update"]);
    Route::post("updatepwd", [MemberController::class, "updatepwd"]);
    Route::get("home", [MemberController::class, "home"])->middleware("member");
});
