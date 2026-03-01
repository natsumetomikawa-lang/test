<?php

namespace App\Http\Controllers;

use App\Models\Greeting;

class GreetingController extends Controller
{
    public function index()
    {
        $greetings = Greeting::latest()->get();
        return view('greetings.index', compact('greetings'));
    }

    public function store()
    {
        Greeting::create([
            'from_name' => request('from_name'),
            'to_name'   => request('to_name'),
            'message'   => request('message'),
        ]);

        return view('greet');
    }

    public function destroy(Greeting $greeting)
    {
        $greeting->delete();
        return redirect('/greetings');
    }
}
