<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Topic;
use App\Models\TopicBody;
use Validator;

class TopicBodyController extends Controller
{
    public function publish (Request $request, $topic)
    {
    	$errors = array();

    	// Validation
    	if (count($request->all()) > 0) {
    		$input = $request->all();
    		$keys = array_keys($input);
    		for ($i=0; $i < count($input); $i++) { 
    			if (empty($input[$i])) {
    				$errors[$keys[$i]] = "This field cannot be empty";
    			}
    		}
    	} else {
    		$errors['message'] = 'You can not send an empty request.';
    	}

    	if (!empty($errors)) {
    		return response()->json($errors, 417);
    	}

    	$topic = Topic::where('name', $topic)->first();

    	if ($topic === null || $topic->exists !== true) {
    		return response()->json(['message' => 'Topic Not Found'], 404);
    	}

    	// Code for compatibility with sqlite and older databases
    	$request_object = serialize($request->all());


    	$published_body = TopicBody::create([
    		'topic' => $topic->name,
    		'data' => $request_object
    	]);

    	$new_data = [
    		'topic' => $published_body->topic,
    		'data' => unserialize($published_body->data)
    	];

    	return response()->json($new_data, 201);
    }
}
