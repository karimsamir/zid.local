<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //register new Merchant
        $request->validate([
            'name' => 'required|max:100',
            'store_name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|max:150',
        ]);
        
        $email = $request->string('email')->trim();

        $merchant = Merchant::where("email", $email)->first();

        if ($merchant) {
            return response()->json([
                'message' => 'error',
                'merchant' => 'Merchant already exists',
                'token' => false,
            ]);    
        }

        // create new merchant
        $merchant = new Merchant();

        $merchant->name = $request->string('name')->trim();
        $merchant->store_name = $request->string('store_name')->trim();
        $merchant->email = $email;
        $merchant->password = Hash::make($request->string('password')->trim());

        $merchant->save();


        $token =  $merchant->createToken("merchant_" . $merchant->id, [
            'store:add', 'store:update', 'products:add', 'products:update'
        ])->plainTextToken;
        
        return response()->json([
            'message' => 'success',
            'merchant' => 'Merchant created successfully',
            'token' => $token,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        //
    }
}
