<?php

namespace App\Http\Controllers;

use App\Models\Agent;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::orderBy('nom')->orderBy('prenom')->paginate(25);
        return view('admin.agents.index', compact('agents'));
    }
}
