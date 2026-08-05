<?php

use App\Http\Controllers\Itec\Attraction\AttractionController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "attraction"], function () {
    Route::get("list", [AttractionController::class, "list"]);
    // 收藏
    Route::post("addfavorite", [AttractionController::class, "addfavorite"]);
    Route::get("home", [AttractionController::class, "home"]);
});
