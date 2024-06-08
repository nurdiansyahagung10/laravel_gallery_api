<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class AccountsController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = new User;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

       
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|max:255|unique:users',
            'namalengkap' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $user = $this->user::create([
            'username' => $request->username,
            'email' => $request->email,
            'namalengkap' => $request->namalengkap,
            'password' => $request->password,
            'alamat' => $request->address,
        ]);

        return response()->json(['message' => 'berhasil'], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if ($request->user()) {
            $user = $request->user()::with('foto')->get();
            return response()->json($user, 200);
        }

        return response()->json(['messages' => 'Not Authenticated'], 401);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = $request->user();

        $validator = validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'namalengkap' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $this->user::where('userid', $user->userid)->update(
            [
                'username' => $request->username,
                'namalengkap' => $request->namalengkap,
                'alamat' => $request->address,
            ]
        );

        return response()->json(['message' => 'berhasil'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $token  = $request->user()->currentAccesstoken();
        $user  = $request->user();

        $token->delete();
        
        return response()->json(['message' => $user], 200);
    }
}
