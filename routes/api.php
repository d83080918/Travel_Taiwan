<?php

use App\Http\Controllers\Itec\Attraction\AttractionController;
use App\Http\Controllers\Itec\Member\MemberController;
use Illuminate\Support\Facades\Route;

Route::get("member/checkemail", [MemberController::class, "checkemail"]);
Route::get("member/checkpwd", [MemberController::class, "checkpwd"]);


Route::get("attraction/getAttractionList", [AttractionController::class, "getList"]);

Route::get("attraction/favoriteAttractionList", [AttractionController::class, "getFavoriteList"]);
