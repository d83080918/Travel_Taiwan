<?php

use App\Http\Controllers\Itec\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin"], function () {
    Route::get("adminhome", [AdminController::class, "adminhome"])->middleware("admin");
    Route::get("create", [AdminController::class, "create"])->middleware("admin");
    Route::post("store", [AdminController::class, "store"])->middleware("admin");
    Route::get("edit/{id}", [AdminController::class, "edit"])->middleware("admin");
    Route::delete("delete", [AdminController::class, "delete"])->middleware("admin");
    Route::post("update", [AdminController::class, "update"])->middleware("admin");
    Route::get("adminchart", [AdminController::class, "adminchart"])->middleware("admin");
});
