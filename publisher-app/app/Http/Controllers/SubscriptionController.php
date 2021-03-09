<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Topic;
use Validator;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, $topic)
    {
    	// Validation
    	$input = $request->all();

    	$validator = Validator::make($input, [
            'url' => ['required', 'url']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

    	// Checking if Topic Exists
    	$topic = Topic::where('name', $topic)->first();

    	if ($topic === null || $topic->exists !== true) {
    		return response()->json(['message' => 'Topic Not Found'], 404);
    	}

    	// Checking if Subscription already exists
    	$subscription = Subscription::where('topic', $topic->name)->where('url', $request->url)->first();
    	if ($subscription !== null || $subscription === true) {
    		return response()->json(['message' => 'Subscription for this topic with url topic already exists.'], 409);
    	}

    	// Saving New Subscription
    	$subscription = Subscription::create([
    		'url' => $request->url,
    		'topic' => $topic->name
    	]);

    	return $subscription;
    }
}
