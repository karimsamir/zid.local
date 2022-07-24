<?php

namespace App\Http\Controllers;

use App\Models\PersonalAccessToken;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        // die(var_dump($request->all()));
        // dd($request);
        $data = $request->all();
        // dd($data["details"]);
        // die(var_dump($data["details"][1]["name"]));

        // $product = json_decode($request->all(), true);
        //register new Product

        $validator = Validator::make($request->all(), [
            'token' => 'required|max:100',
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'shipping_cost' => 'required|numeric',
            'is_vat_included' => 'required|boolean',
            'vat_percentage' => 'required|numeric|min:0|max:100',
            // 'details' => 'array:language, name, description',
            // 'details.*.language' => 'required|min:2|max:2',
            // 'details.*.name' => 'required|max:100',
        ]);
 
        if ($validator->fails()) {
        //    dd(get_class_methods($validator));
           dd($validator->getMessageBag());
        }
 
        // // Retrieve the validated input...
        // $validated = $validator->validated();

        // $request->validate([
        //     'name' => 'required|max:100',
        //     'price' => 'required|numeric',
        //     'shipping_cost' => 'required|nsumeric',
        //     'is_vat_included' => 'required|boolean',
        //     'vat_percentage' => 'required|numeric|min:0|max:100',
        //     'details' => 'array:language, name, description',
        //     'details.*.language' => 'required|min:2|max:2',
        //     'details.*.name' => 'required|max:100',


        // ]);

        // dd("karim");

        // check if merchant send a valid token
        // $token = PersonalAccessToken::find

        // create new product
        $product = new Product();

        $product->name = $request->string('name')->trim();
        $product->price = $request->string('price')->trim();
        $product->shipping_cost = $request->string('shipping_cost')->trim();
        $product->vat_percentage = $request->string('vat_percentage')->trim();
        $product->is_vat_included = $request->string('is_vat_included')->trim();
        
        $product->save();

        // dd($product);

        $details = $request->input("details");
        
        $product_details = array();

        foreach ($details as $key => $value) {
            // $product_detail = new ProductDetail();

            $product_details[$key]["language"] = $value["language"];
            $product_details[$key]["name"] = $value["name"];
            $product_details[$key]["description"] = $value["description"];
            
        }

        $product->product_details()->saveMany($product_details);
        

        dd($product);
        
        return response()->json([
            'message' => 'success',
            'product' => 'Product created successfully',
            // 'token' => $token,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
