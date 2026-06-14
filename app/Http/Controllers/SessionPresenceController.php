<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionPresenceController extends Controller
{
    // index, create, store, show, edit, update, destroy
    public function index()
    {
        $sessions = \App\Models\SessionPresence::with('pointPresence')->get();
        return view('admin.session-presences.index', compact('sessions'));
    }

    public function create()
    {
        $pointPresences = \App\Models\PointPresence::all();
        return view('admin.session-presences.create', compact('pointPresences'));
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date_presence' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'point_presence_id' => 'required|exists:point_presences,id',
        ]);

        // Create SessionPresence
        $sessionPresence = \App\Models\SessionPresence::create($validated);

        return redirect()->route('admin.session-presences.index')->with('success', 'Session de présence créée avec succès.');
    }

    public function edit($id)
    {
        $sessionPresence = \App\Models\SessionPresence::findOrFail($id);
        $pointPresences = \App\Models\PointPresence::all();
        return view('admin.session-presences.edit', compact('sessionPresence', 'pointPresences'));
    }

    public function update(Request $request, $id)
    {
        $sessionPresence = \App\Models\SessionPresence::findOrFail($id);

        // Validation
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date_presence' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'point_presence_id' => 'required|exists:point_presences,id',
        ]);

        // Update SessionPresence
        $sessionPresence->update($validated);

        return redirect()->route('admin.session-presences.index')->with('success', 'Session de présence mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $sessionPresence = \App\Models\SessionPresence::findOrFail($id);
        $sessionPresence->delete();

        return redirect()->route('admin.session-presences.index')->with('success', 'Session de présence supprimée avec succès.');
    }

}
