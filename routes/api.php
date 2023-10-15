<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('group', [GroupController::class, 'index']);
Route::get('group/{id}', [GroupController::class, 'view']);
Route::post('group', [GroupController::class, 'create']);
Route::put('group/{id}', [GroupController::class, 'update']);
Route::delete('member/{id}', [MemberController::class, 'delete']);
Route::get('member', [MemberController::class, 'index']);
Route::get('member/{id}', [MemberController::class, 'view']);
Route::post('member', [MemberController::class, 'create']);
Route::put('member/{id}', [MemberController::class, 'update']);
Route::delete('member/{id}', [MemberController::class, 'delete']);
