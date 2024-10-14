<?php

namespace App\Http\Controllers\Dashbaord;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameController extends Controller
{
    //--games
    public function games()
    {
        $games = Game::latest()->get();
        return view('dashboard.games.index', compact('games'));
    }
    //--create
    public function create()
    {
        return view('dashboard.games.create');
    }
    //--store
    public function store(Request $request)
    {
        //  return $request->all();
        $request->validate([
            'name' => 'required',
            'link' => 'required',
        ]);

        // Handling image file upload
        $imagePath = null; 
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/games'), $imageName);
            $imagePath = 'images/games/' . $imageName; 
        }


        $game = Game::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'game_link' => $request->link,
            'category' => $request->gameCategory,
            'image_link' => $request->imagelink,
            'image' => $imagePath,
            'description' => $request->description,
            'status' => $request->gameStatus,
        ]);

        return redirect()->route('games')->with('success', 'Game Upload Successfully!');
    }
}
