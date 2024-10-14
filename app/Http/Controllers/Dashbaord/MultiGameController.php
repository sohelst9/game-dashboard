<?php

namespace App\Http\Controllers\Dashbaord;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MultiGameController extends Controller
{
    //--create
    public function create()
    {
        return view('dashboard.multigames.create');
    }

    //--store
    public function store(Request $request)
    {
        $request->validate([
            'gametype' => 'required',
            'gamelink' => 'required',
        ]);

        $count_game = 0;

        if ($request->gametype == 'gamepix') {
            $api_url = $request->gamelink;
            $post_data = Http::get($api_url);
            $datas = json_decode($post_data->body());

            foreach ($datas->items as $data) {
              $data = (array)$data;
                $same_game = Game::where('name', $data['title'])->first();
                if ($same_game) {
                    continue;
                }


                // URL to downlaod image
                $imageUrl = $data['banner_image'] ?? $data['banner_image'] ?? null;
                // SSL off
                $context = stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);

                // image download
                $imageContent = file_get_contents($imageUrl, false, $context);

                if ($imageContent === false) {
                    return response()->json(['message' => 'Could not download the image.'], 400);
                }

                // create image file
                $imageResource = imagecreatefromstring($imageContent);

                if ($imageResource === false) {
                    return response()->json(['message' => 'Invalid image.'], 400);
                }
                // get image current size
                $width = imagesx($imageResource);
                $height = imagesy($imageResource);

                // new image size add
                $newWidth = 320;
                $newHeight = 197;

                //  create new image canvas
                $resizedImageResource = imagecreatetruecolor($newWidth, $newHeight);

                // resize image
                imagecopyresampled($resizedImageResource, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                // make WebP file 
                $imageName = Str::slug($data['title'], '-') . '-' . uniqid() . '.webp';
                $imagePath = public_path('images/games/' . $imageName);

                $imagePathDatabaseSave = 'images/games/' . $imageName; 

                // image save webp
                imagewebp($resizedImageResource, $imagePath, 90); // 90 মানে হচ্ছে কোয়ালিটি

                // memory to image resource free 
                imagedestroy($imageResource);
                imagedestroy($resizedImageResource);
                // return response()->json(['message' => 'Image saved successfully!', 'image_path' => $imagePath]);

                $game_id = Game::insertGetId([
                    'name' => $data['title'],
                    'slug' => Str::slug($data['title'], '-'),
                    'game_link' => $data['url'],
                    'type' => $request->game_type,
                    'description' => $data['description'],
                    'image' => $imagePathDatabaseSave,
                    'image_link' => $imageUrl,
                    'category' => $data['category'] ?? 'NA',
                    'status' => 1,
                    'created_at' => now()
                ]);

                if ($game_id) {
                    $count_game++;
                }
            }
        }

        return redirect()->route('games')->with('success', $count_game . ' Games Inserted Successfully !');
    }
}
