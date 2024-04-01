<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayeredController extends Controller
{
    public function index()
    {
        return view('layered.index', [
            'title' => 'Layered Dev'
        ]);
    }

    public function addNew()
    {
        return view('layered.add');
    }

    public function createNewLayer(Request $request)
    {
        return redirect()->route('layer.index')->with([
            'message' => 'hello',
        ]);
    }
}
