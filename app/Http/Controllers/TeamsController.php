<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamsController extends Controller
{
    public function index()
    {
        // Haal alle teams op, inclusief de gebruikers die ze hebben aangemaakt
        $teams = Team::with('user')->get();

        // Toon de teambeheer pagina
        return view('teams.teambeheer', compact('teams'));
    }

    public function store(Request $request)
    {
        // Validatie
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Maak een nieuw team aan, gekoppeld aan de ingelogde gebruiker
        Team::create([
            'name' => $request->name,
        ]);

        return redirect()->route('teams.index')->with('success', 'Team succesvol aangemaakt!');
    }
}

