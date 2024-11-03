<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //--index
    public function index()
    {
        $datas = [
            ['name' => 'sohel', 'age' => 10],
            ['name' => 'rana', 'age' => '25']
        ];
        $data = "Lorem ipsum dolor sit amet consectetur adipisicing elit";
        event(new TestEvent($data, $datas));
        return view('welcome');
    }
}
