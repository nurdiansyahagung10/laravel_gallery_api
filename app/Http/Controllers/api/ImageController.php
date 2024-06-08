<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\foto;
use Validator;
class ImageController extends Controller
{
    private $foto;
    private $user;

    public function __construct(){
        $this->foto = new foto;
        $this->user = new User;
    }

    public function index()
    {
        $data = $this->foto::with('user')->get();

        return response()->json($data, 200);
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
            'judulfoto' => 'required|string|max:255|unique:foto',
            'deskripsi' => 'string',
            'image' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->messages());
        }    
        
        $image = $request->file('image');
        
        $newimage = $request->user()->username.'-'.time().'.'.$image->getClientOriginalExtension();

        $user = $this->foto::create([
            'judulfoto' => $request->judulfoto,
            'deskripsifoto' => $request->deskripsifoto,
            'lokasifile' => $newimage,
            'userid' => $request->user()->userid,
        ]);

        if($user) {
            $image->storeAs('images', $newimage, 'public');

            return response()->json(['messages' => 'berhasil'], 200);

        }


        return response()->json(['messages' => 'tidak berhasil menambah data'], 401);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
