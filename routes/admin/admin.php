<?php

use App\Http\Controllers\Itec\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin"], function () {
    Route::get("adminhome", [AdminController::class, "adminhome"]);
    Route::get("create", [AdminController::class, "create"]);
    Route::post("store", [AdminController::class, "store"]);
    Route::get("edit/{id}", [AdminController::class, "edit"]);
    Route::delete("delete", [AdminController::class, "delete"]);
    Route::post("update", [AdminController::class, "update"]);
    Route::post("logout", [AdminController::class, "logout"]);
});
