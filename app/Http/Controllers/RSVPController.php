<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RSVP;


class RSVPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {  
        $event_id = $request->query('event_id');
        return view('rsvp', compact('event_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:32',
            'response' => 'required|in:yes,no,maybe',
            'event_id' => 'required|string',
            'comment' => 'nullable|string'
        ]);
        RSVP::create($validated);
        return redirect()->route('events.show', $validated['event_id'])->with('success', 'RSVP submitted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
