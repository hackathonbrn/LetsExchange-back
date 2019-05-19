<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Category;

class AuthController extends Controller
{
    protected $redirectTo = '/';
    public function register(Request $request)
    {
        $rules = [
        'name' => 'unique:users|required',
        'email'    => 'unique:users|required',
        'password' => 'required',
        ];

        $input     = $request->only('name', 'email','password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }else if($request->password_confirmation != $request->password){
            return response()->json(['success' => false, 'error' => 'password_error']);
        }

        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        return response()->json(['success' => true, 'user' => $user]);
    }
    public function login(Request $request)
    {
        $email    = $request->email;
        $password = $request->password;
        if ($status = Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            if(!empty($user->console_id)){
                $console = Category::getByConsole($user->console_id);
            }
            return response()->json(['success' => true, 'status' => $status, 'user'=>$user, 'console' => $console]);
        }else{
            return response()->json(['success' => false, 'error' => 'noAuth']);
        }
    }
    public function updateConsole(Request $request)
    {
        $id = $request->id;
        $id_console = $request->id_console;
        if(!empty($id_console)){
            User::where('id', $id)
                ->update(['console_id' => $id_console]);
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
}
