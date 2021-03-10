<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Validator;

class NotificationController extends Controller
{
    public function create(Request $request, $route) {
    	// Validation
    	if (empty($route)) {
    		return response()->json(['message' => 'Something went wrong!'], 400);
    	}

    	$input = $request->all();

    	$validator = Validator::make($input, [
            'topic' => ['required'],
            'data' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $notification_data = Notification::create([
        	'endpoint' => $route,
        	'topic' => $request->topic,
        	'data' => serialize($request->data)
        ]);

        return $notification_data;
    }

    public function test1(Request $request) {
    	$response = $this->create($request, 'test1');

    	return $response;
    }

    public function test2(Request $request) {
    	$response = $this->create($request, 'test2');

    	return $response;
    }

    public function latest($route) {
    	// Validation
    	if (empty($route)) {
    		return response()->json(['message' => 'Something went wrong!'], 400);
    	}

    	$notification = Notification::where('endpoint', $route)->latest('created_at')->first();

    	if (!empty($notification) || $notification !== null) {
    		$notification_data = [
    			'topic' => $notification->topic,
    			'data' => unserialize($notification->data)
    		];

    		return response()->json($notification_data, 200);
    	}

    	return response()->json(['message' => 'No recent posts'], 404);
    }

    public function test1_get() {
    	$response = $this->latest('test1');

    	return $response;
    }

    public function test2_get() {
    	$response = $this->latest('test2');

    	return $response;
    }
}
