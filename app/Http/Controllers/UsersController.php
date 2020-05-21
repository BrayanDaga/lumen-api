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


    public function store(Request $request)
    {
        if($request->isJson()){
            $data = $request->json()->all();
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'apitoken' => Str::random(60)

            ]);
            return response()->json([$user], 201);
        }
        return response()->json(['error'=>'Unauthorized'],401,[]);
    }


}
