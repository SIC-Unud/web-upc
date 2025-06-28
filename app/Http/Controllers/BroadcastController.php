<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Broadcast;

class BroadcastController extends Controller
{
    public function index()
    {
        $broadcasts = Broadcast::latest()->get();
        return view("admin.informasi-admin", compact("broadcasts"));
    }

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

        return redirect()->back()->with("message", "Broadcast berhasil ditambahkan");
    }

    public function update(Request $request, $id)
    {

        try {
            $found_broadcast = Broadcast::findOrFail($id);
            $validated = $request->validate([
                "title" => "string|max:255",
                "broadcast" => "string",
                "created_by" => "numeric"
            ]);

            $found_broadcast->title = $validated["title"];
            $found_broadcast->broadcast = $validated["broadcast"];

            $found_broadcast->save();

            return redirect()->back()->with("message", "Broadcast berhasil diedit");
        } catch (Exception $e) {
            return redirect()->back()->with("message", "Broadcast tidak ditemukan");
        }
    }

    public function destroy(Broadcast $broadcast)
    {
        $broadcast->delete();
        return back()->with('message', 'Broadcast berhasil dihapus');
    }
}
