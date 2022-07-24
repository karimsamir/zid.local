<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //add new Product
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
            return $this->sendError(
                'Invalid.',
                ['error' => $validator->getMessageBag()]
            );
        }

        // create new product
        $product = new Product();

        $product->name = trim($request->name);
        $product->user_id = Auth::user()->id;
        $product->price = $request->price;
        $product->shipping_cost = $request->shipping_cost;
        $product->vat_percentage = $request->vat_percentage;
        $product->is_vat_included = $request->is_vat_included;

        $product->save();

        $details = $request->input("details");


        if (!empty($details)) {
            $product_details = array();

            foreach ($details as $value) {
                $product_detail = new ProductDetail();

                $product_detail->language = $value["language"];
                $product_detail->name = $value["name"];
                $product_detail->description = $value["description"];

                array_push($product_details, $product_detail);
            }
            $product->product_details()->saveMany($product_details);
        }

        return response()->json([
            'message' => 'success',
            'product' => 'Product created successfully',
            'product_id' => $product->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        //update Product
        $validator = Validator::make($request->all(), [
            'token' => 'required|max:100',
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'shipping_cost' => 'required|numeric',
            'is_vat_included' => 'required|boolean',
            'vat_percentage' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return $this->sendError(
                'Invalid.',
                ['error' => $validator->getMessageBag()]
            );
        }

        $product->name = trim($request->name);
        $product->price = $request->price;
        $product->shipping_cost = $request->shipping_cost;
        $product->vat_percentage = $request->vat_percentage;
        $product->is_vat_included = $request->is_vat_included;

        $product->save();

        return response()->json([
            'message' => 'success',
            'product' => 'Product updated successfully',
            'product_id' => $product->id,
        ]);
    }
}
