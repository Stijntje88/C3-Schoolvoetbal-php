<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index()
    {
        // Alleen wedstrijden ophalen zonder scores
        $games = Game::whereNull('team_1_score')
                    ->whereNull('team_2_score')
                    ->get();

        return view('games.index', ['games' => $games]);
    }

    public function leaderboard($tournament_id)
    {
        // Haal alle wedstrijden voor dit toernooi op
        $games = Game::where('tournament_id', $tournament_id)
                    ->get();

        // Maak een array voor de scores van de teams
        $teamScores = [];

        // Verwerk de scores van alle wedstrijden
        foreach ($games as $game) {
            // Verwerk de score van team 1
            if (!isset($teamScores[$game->team_1])) {
                $teamScores[$game->team_1] = 0;
            }
            $teamScores[$game->team_1] += $game->team_1_score > $game->team_2_score ? 3 : ($game->team_1_score === $game->team_2_score ? 1 : 0);

            // Verwerk de score van team 2
            if (!isset($teamScores[$game->team_2])) {
                $teamScores[$game->team_2] = 0;
            }
            $teamScores[$game->team_2] += $game->team_2_score > $game->team_1_score ? 3 : ($game->team_1_score === $game->team_2_score ? 1 : 0);
        }

        // Haal de teams op en voeg ze toe aan de scores
        $teams = Team::whereIn('id', array_keys($teamScores))->get();

        // Voeg de scores toe aan de teams en sorteer ze op score
        $leaderboard = $teams->map(function($team) use ($teamScores) {
            $team->score = $teamScores[$team->id];
            return $team;
        })->sortByDesc('score'); // Sorteer van hoog naar laag

        // Retourneer de view met het leaderboard
        return view('games.leaderboard', ['leaderboard' => $leaderboard]);
    }

    public function show()
    {
        $tournaments = Tournament::all();

        return view('games.leaderboardhome', ['tournaments' => $tournaments]);
    }

    public function generateMatches(Request $request)
    {
        $teams = Team::all();

        foreach ($teams as $team_1) {
            $i = $team_1->id;
            foreach ($teams as $team_2) {
                $j = $team_2->id;
                if ($j > $i) {
                    $game = Game::create([
                        'team_1' => $i,
                        'team_2' => $j,
                        'tournament_id' => 1,
                    ]);
                }
            }
        }

        return redirect()->route('home');
    }

    public function scoresTonen()
    {
        $games = Game::all();

        return view('referee.scores', ['games' => $games]);
    }

    public function addScores()
    {
        $games = Game::all();

        return view('referee.addScores', ['games' => $games]);
    }

    public function storeScores(Request $request, Game $game)
    {
        $request->validate([
            'team1' => ['integer'],
            'team2' => ['integer']
        ]);

        $game->update([
            'team_1_score' => $request->team1,
            'team_2_score' => $request->team2,
        ]);

        return redirect()->route('referee.scores');
    }

    public function onlyScores()
    {
        $games = Game::all(['team_1', 'team_2', 'team_1_score', 'team_2_score']);

        return view('scores.index', ['games' => $games]);
    }
    // Haal alle games zonder scores in JSON-formaat
public function getGamesJson()
{
    $games = Game::whereNull('team_1_score')
                 ->whereNull('team_2_score')
                 ->get();

    return response()->json($games);
}

// Haal de resultaten van alle games in JSON-formaat
public function getResultsJson()
{
    $games = Game::all(['team_1', 'team_2', 'team_1_score', 'team_2_score']);

    return response()->json($games);
}

}
