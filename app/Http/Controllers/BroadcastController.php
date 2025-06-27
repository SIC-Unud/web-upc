<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Broadcast;

class BroadcastController extends Controller
{
    public function index()
    {
        $broadcasts = Broadcast::all();
        return view("informasi-admin", compact("broadcasts"));
    }

    // public function view($id)
    // {
    //     $broadcast = Broadcast::find($id);

    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "string|max:255",
            "broadcast" => "string",
            "created_by" => "numeric"
        ]);

        $broadcast = Broadcast::create([
            "title" => $validated["title"],
            "broadcast" => $validated["broadcast"],
            "created_by" => $validated["created_by"]
        ]);

        return redirect()->back()->with("message", "Broadcast success created");
    }
}
