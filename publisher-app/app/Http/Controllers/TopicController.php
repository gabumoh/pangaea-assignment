<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use Validator;

class TopicController extends Controller
{
	public function index () {
		$topics = Topic::paginate(25);
		return $topics;
	}

    public function create (Request $request)
    {
    	// Validation
    	$input = $request->all();

    	$validator = Validator::make($input, [
            'name' => ['required', 'string', 'unique:topics']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $topic = Topic::create([
        	'name' => $request->name
        ]);

        return $topic;
    }
}
