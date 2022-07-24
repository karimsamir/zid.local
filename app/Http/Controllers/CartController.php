<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        //add new Product to cart
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError(
                'Invalid.',
                ['error' => $validator->getMessageBag()]
            );
        }

        // create new cart
        $cart = new Cart();

        $cart->product_id = $request->product_id;
        $cart->user_id = $user->id;
        $cart->quantity = $request->quantity;

        $cart->save();

        $all_carts = Cart::where("user_id", $user->id)
        ->with("product")
        ->get();

        $total = 0;
        foreach ($all_carts as $key => $cart_details) {
            
            
            $product_price = $cart_details->product->price;
            if (!$cart_details->product->is_vat_included) {
                $product_price = $product_price * (1 + ($cart_details->product->vat_percentage/100));
            }
            $product_price = $product_price + $cart_details->product->shipping_cost;

            $total += ($product_price * $cart_details->quantity);

        }

        return response()->json([
                'message' => 'success',
            'cart' => 'Product added to cart successfully',
            'total_price' => round($total, 2),
        ]);
    }

}
