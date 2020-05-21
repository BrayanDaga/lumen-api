<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        return response()->json(User::find($id));
    }

    public function login(Request $request)
    {
        if($request->isJson()){
            try {
                $data = $request->json()->all();
                $user = User::where('username',$data['username'])->first();
                if($user && Hash::check($data['password'], $user->password)){
                    return response()->json($user,200);
                }
                else{
                    return response()->json(['error'=>'No content'],406);
                }
            } catch (ModelNotFoundException $e) {
                return response()->json(['error'=>'No content'],406);
            }
            return response()->json(['error'=>'Unauthorized'],401,[]);
        }
    }

}
