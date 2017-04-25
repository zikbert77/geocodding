<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/login';

    public function authenticate(Request $request)
    {

        if (!isset($_SESSION['user_id']) || !$_SESSION['user_id']){

            $email = $request->input('email');
            $password = $request->input('password');

            $user = User::where('email', $email)->where('password', $password)->get();

            $_SESSION['user_id'] = isset($user[0]->id)? $user[0]->id : false;

            if ($_SESSION['user_id']){
                return redirect()->route('admin');
            }

            return redirect()->route('loginPage');
        }

    }

    public function getLoginPage()
    {
        if (!isset($_SESSION['user_id']) || !$_SESSION['user_id']) {
            return view('login');
        } else {
            return redirect()->route('admin');
        }
    }
}