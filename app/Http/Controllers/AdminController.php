<?php

namespace App\Http\Controllers;

use App\Ip;
use App\Like;
use Illuminate\Http\Request;
use App\Position;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $positions = Position::all();
        $new = Position::get()->where('status', 0)->count();

        $data = [
            'title' => 'Admin',
            'positions' => $positions,
            'new' => $new
        ];

        return view('admin', $data);
    }

    public function update(Request $request, $id)
    {

        $place = Position::find($id);

        if($request->input('update') != null){

            $new_place = [];
            $new_place['place_name'] = $request->input('place_name');
            $new_place['place_lat'] = $request->input('place_lat');
            $new_place['place_lng'] = $request->input('place_lng');
            $new_place['description'] = $request->input('place_descr');

            $place->position_name = $new_place['place_name'];
            $place->position_lat = $new_place['place_lat'];
            $place->position_lng = $new_place['place_lng'];
            $place->description = $new_place['description'];

            $place->save();

            return redirect()->route('admin');
        }



        $data = [
            'title' => 'Update',
            'place_id' => $id,
            'place' => $place
        ];

        return view('update', $data);
    }

    public function confirm($id){

        $pos = Position::find($id);
        $pos->status = 1;
        $pos->save();

        return redirect()->route('admin');
    }

    public function delete($id){

        $ips = Ip::where('position_id', $id)->first();

        $like = Like::where('p_id', $id)->first();

        $pos = Position::find($id);

        if($like != null)
            $like->delete();

        if($ips != null)
            $ips->delete();

        if($pos != null)
            $pos->delete();

        return redirect()->route('admin');
    }
}
