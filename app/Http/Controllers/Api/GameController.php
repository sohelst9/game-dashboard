<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //--games
    public function games(Request $request)
    {
        $limit = $request->input('limit');
        if ($limit) {
            $games = Game::limit($limit)->get();
            return GameResource::collection($games);
        }

        $games = Game::paginate(33);
        return GameResource::collection($games);
    }

    //--game
    public function game($slug)
    {
        $game = Game::where('slug', $slug)->first();
        $related_games = Game::where('category', $game->category)->take(12)->get();
        return response()->json([
            'game' => new GameResource($game),
            'related_games' => GameResource::collection($related_games),
        ]);
    }
}