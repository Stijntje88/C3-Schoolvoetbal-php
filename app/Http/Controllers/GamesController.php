<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index(){
        $games = Game::all();
        return view('games.index', ['games' => $games]);
    }

    public function generateMatches(){
        $teams = Team::all();

        foreach($teams as $team_1){
            $i = $team_1->id;
            foreach($teams as $team_2){
                $j = $team_2->id;
                if($j > $i){
                    $game = Game::create([
                        'team_1' => $i,
                        'team_2' => $j,
                        'tournament_id' => 1,
                    ]);
                }
            }
        }

        $games = Game::all();
        return redirect()->route('home');
    }
}
