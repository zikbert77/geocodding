<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;

class AdminController extends Controller
{
    //

    public function index(){

        $positions = Position::all();
        $new = count(Position::get()->where('status', 0));

        $data = [
            'title' => 'Admin',
            'positions' => $positions,
            'new' => $new
        ];

        return view('admin', $data);
    }

    public function confirm($id){

        $pos = Position::find($id);
        $pos->status = 1;
        $pos->save();

        return redirect()->route('admin');
    }

    public function delete($id){

        $pos = Position::find($id);
        $pos->delete();

        return redirect()->route('admin');
    }
}
