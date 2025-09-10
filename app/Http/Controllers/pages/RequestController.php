<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\It_Request;

class RequestController extends Controller
{
    //
    public function index() 
    {
        $services = It_Request::paginate(6);
        // dd($movies);
        return view('dashboard',compact('services'));
    }

    public function store(request $request) {
        // dd($request->all());
        $service = It_Request::create($request->all());
        return redirect(route('dashboard'));
    }

    
}
