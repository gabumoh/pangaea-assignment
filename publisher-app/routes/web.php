<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TopicBodyController;

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

// Subscribe Routes
Route::post('/subscribe/{topic}', [SubscriptionController::class, 'subscribe']);
// Adding Custom error for other http methods on this route
Route::get('/subscribe/{topic}', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::put('/subscribe/{topic}', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::patch('/subscribe/{topic}', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::delete('/subscribe/{topic}', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});

// Topic Routes
Route::get('/topic', [TopicController::class, 'index']);
Route::post('/topic', [TopicController::class, 'create']);
// Adding Custom error for other http methods on this route
Route::put('/topic', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::patch('/topic', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::delete('/topic', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});

// Publish Routes
Route::post('/publish/{topic}', [TopicBodyController::class, 'publish']);
Route::get('/publish/{topic}', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::put('/publish/{topic}', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::patch('/publish/{topic}', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});
Route::delete('/publish/{topic}', function () {
	return response()->json(['message' => 'Method not allowed!'], 405);
});