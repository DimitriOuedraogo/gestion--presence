<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date_presence' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
            'point_presence_id' => 'required|exists:point_presences,id',
        ]);

        $validated['token'] = Str::uuid()->toString();

        $session = \App\Models\SessionPresence::create($validated);

        // Génération du QR code — on force APP_URL pour que l'IP soit celle du .env
        $url = rtrim(config('app.url'), '/') . '/presence/' . $session->token;
        Storage::disk('public')->makeDirectory('qrcodes');
        $cheminRelatif = 'qrcodes/session_' . $session->id . '.svg';
        $svgContent = QrCode::format('svg')->size(300)->margin(1)->generate($url);
        Storage::disk('public')->put($cheminRelatif, $svgContent);

        $session->update(['qr_code_chemin' => $cheminRelatif]);

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

    public function presences($id)
    {
        $session = \App\Models\SessionPresence::with(['presences.agent', 'pointPresence'])->findOrFail($id);
        return view('admin.session-presences.presences', compact('session'));
    }

    public function exportPresences($id)
    {
        $session = \App\Models\SessionPresence::with(['presences.agent'])->findOrFail($id);
        $filename = 'presences_' . \Illuminate\Support\Str::slug($session->nom) . '_' . $session->date_presence . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PresencesExport($session), $filename);
    }

    public function regenererQrCodes()
    {
        $sessions = \App\Models\SessionPresence::whereNotNull('token')->get();

        Storage::disk('public')->makeDirectory('qrcodes');

        foreach ($sessions as $session) {
            $url           = rtrim(config('app.url'), '/') . '/presence/' . $session->token;
            $cheminRelatif = 'qrcodes/session_' . $session->id . '.svg';
            $svgContent    = QrCode::format('svg')->size(300)->margin(1)->generate($url);
            Storage::disk('public')->put($cheminRelatif, $svgContent);
            $session->update(['qr_code_chemin' => $cheminRelatif]);
        }

        return redirect()->route('admin.session-presences.index')
            ->with('success', $sessions->count() . ' QR code(s) régénéré(s) avec la nouvelle URL.');
    }

}
