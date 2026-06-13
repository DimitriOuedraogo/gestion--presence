<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointPresenceController extends Controller
{
    // index, create, store, show, edit, update, destroy

    public function index()
    {

        $pointPresences = \App\Models\PointPresence::withCount('sessions')->get();
        return view('admin.point-presences.index', compact('pointPresences'));
    }

    public function create()
    {
        return view('admin.point-presences.create');
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'rayon_autorise' => 'required|numeric',
        ]);

        // Create PointPresence
        $pointPresence = \App\Models\PointPresence::create($validated);

        return redirect()->route('admin.point-presences.index')->with('success', 'Point de présence créé avec succès.');
    }

    public function show($id)
    {
        $pointPresence = \App\Models\PointPresence::findOrFail($id);
        return view('admin.point-presences.show', compact('pointPresence'));
    }

    public function edit($id)
    {
        $pointPresence = \App\Models\PointPresence::findOrFail($id);
        return view('admin.point-presences.edit', compact('pointPresence'));
    }

    public function update(Request $request, $id)
    {   
        $pointPresence = \App\Models\PointPresence::findOrFail($id);
        
        // Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'rayon_autorise' => 'required|numeric',
            ]);
            
            // Update PointPresence
            $pointPresence->update($validated);

        return redirect()->route('admin.point-presences.index')->with('success', 'Point de présence mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $pointPresence = \App\Models\PointPresence::findOrFail($id);
        $pointPresence->delete();

        return redirect()->route('admin.point-presences.index')->with('success', 'Point de présence supprimé avec succès.');
    }
}
