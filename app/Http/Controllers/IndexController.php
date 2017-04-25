<?php

namespace App\Http\Controllers;

use App\Like;
use App\Position;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index(Request $request){

        if($request->has('position_id')){
            $pos_id = $request->input('position_id');
            $like = Like::where('p_id', $pos_id)->first();
            $like->likes += 1;
            $like->save();
        }

        $positions = Position::get()->where('status', 1);
        $data = [
            'title' => 'Google maps API web-site',
            'positions' => $positions
        ];


        return view('index', $data);
    }

    public function getPosition(){
        $positions = Position::get()->where('status', 1);
        $json_positions = [];

        $i=0;
        foreach ($positions as $pos){

            $json_positions[$i][] = $pos->position_name;
            $json_positions[$i][] = $pos->position_lat;
            $json_positions[$i][] = $pos->position_lng;
            $json_positions[$i][] = $pos->description;
            $i++;
        }

        return json_encode($json_positions);
    }

    public function setPosition(Request $request){

            $position['name'] = $_GET['p_name'];
            $position['descr'] = $_GET['p_descr'];
            $position['lat'] = $_GET['p_lat'];
            $position['lng'] = $_GET['p_lng'];

            $sql = "INSERT INTO `positions` (position_name, position_lat, position_lng, description) VALUES (?,?,?,?)";
            DB::insert($sql, [
                $position['name'],
                $position['lat'],
                $position['lng'],
                $position['descr']
            ]);

        return json_encode($position);
    }
}
