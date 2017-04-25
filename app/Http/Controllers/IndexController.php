<?php

namespace App\Http\Controllers;

use App\Ip;
use App\Like;
use App\Position;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index(Request $request){

        $ip = self::get_ip();

        if($request->has('position_id')){

            $pos_id = $request->input('position_id');
            $check_ip = Ip::where('position_id', $pos_id)->where('ip', $ip)->first();

            if (!$check_ip){
                $like = Like::where('p_id', $pos_id)->first();
                $like->likes += 1;
                $like->save();
                $ips = new Ip;
                $ips->ip = $ip;
                $ips->position_id = $pos_id;
                $ips->save();

            } else {
                echo "Не можна ставити більше 1 лайка";
            }


        }

        $positions = Position::where('status', 1)->get();
        dump($positions);
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

            $p_id = Position::insertGetId([
                    'position_name' => $position['name'],
                    'position_lat' => $position['lat'],
                    'position_lng' => $position['lng'],
                    'description' => $position['descr']
                ]);

            $likes = new Like;
            $likes->p_id = $p_id;
            $likes->likes = 0;
            $likes->save();

        return json_encode($position);
    }

    protected function get_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
