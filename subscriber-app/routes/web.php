<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/test1', [NotificationController::class, 'test1']);
Route::post('/test2', [NotificationController::class, 'test2']);

Route::get('/test1', [NotificationController::class, 'test1_get']);
Route::get('/test2', [NotificationController::class, 'test2_get']);

Route::put('/test1', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::put('/test2', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});

Route::patch('/test1', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::patch('/test2', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});

Route::delete('/test1', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::delete('/test2', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
