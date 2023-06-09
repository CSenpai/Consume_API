<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\StudentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
