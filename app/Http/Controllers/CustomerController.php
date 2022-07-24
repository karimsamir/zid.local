<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
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
                //register new Customer
                $request->validate([
                    'name' => 'required|max:100',
                    'email' => 'required|email',
                    'password' => 'required|max:150',
                ]);
                
                $email = $request->string('email')->trim();
        
                $customer = Customer::where("email", $email)->first();
        
                if ($customer) {
                    return response()->json([
                        'message' => 'error',
                        'customer' => 'Customer already exists',
                        'token' => false,
                    ]);    
                }
        
                // create new customer
                $customer = new Customer();
        
                $customer->name = $request->string('name')->trim();
                $customer->email = $email;
                $customer->password = Hash::make($request->string('password')->trim());
        
                $customer->save();
        
                $token =  $customer->createToken("customer_" . $customer->id, [
                    'cart:add', 'cart:update'
                ])->plainTextToken;
                
                return response()->json([
                    'message' => 'success',
                    'customer' => 'Customer created successfully',
                    'token' => $token,
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
                //register new Customer
                $request->validate([
                    'name' => 'required|max:100',
                    'email' => 'required|email',
                    'password' => 'required|max:150',
                ]);
                
                $email = $request->string('email')->trim();
        
                $customer = Customer::where("email", $email)->first();
        
                if ($customer) {
                    return response()->json([
                        'message' => 'error',
                        'customer' => 'Customer already exists',
                        'token' => false,
                    ]);    
                }
        
                // create new customer
                $customer = new Customer();
        
                $customer->name = $request->string('name')->trim();
                $customer->email = $email;
                $customer->password = Hash::make($request->string('password')->trim());
        
                $customer->save();
        
                $token =  $customer->createToken("customer_" . $customer->id, [
                    'cart:add', 'cart:update'
                ])->plainTextToken;
                
                return response()->json([
                    'message' => 'success',
                    'customer' => 'Customer created successfully',
                    'token' => $token,
                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
