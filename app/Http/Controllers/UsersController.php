<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
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
        return User::all();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function login(Request $request)
    {
            try {
                //$data = $request->all();
                $user = User::where('username',$request['username'])->first();
                if($user && Hash::check($request['password'], $user->password)){
                    return $user;
                }
                else{
                    return response()->json(['error'=>'No content'],406);
                }
            } catch (ModelNotFoundException $e) {
                return response()->json(['error'=>'No content'],406);
            }

    }


    public function store(Request $request)
    {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
            ]);
            //$data = $request->json()->all();
            $user = User::create([
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'apitoken' => Str::random(60)

            ]);
            return $user;

    }


}
