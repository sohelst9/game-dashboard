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
        $search = $request->input('search'); // Get search input from the request

        // Query builder for fetching games
        $query = Game::latest();

        // If a search term is provided, apply the search filter
        if ($search) {
            $query->where('name', 'like', "%{$search}%"); // Assuming 'name' is the column you want to search
        }

        if ($limit) {
            $games = $query->limit($limit)->get();
            return GameResource::collection($games);
        }

        $games = $query->paginate(24); // Paginate the results
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
