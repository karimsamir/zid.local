<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

    public function login(Request $request) {

        if (Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password
            ])) {
            $authUser = Auth::user();

            $success['token'] =  $this->createUserToken($authUser);

            $success['name'] =  $authUser->name;

            return $this->sendResponse($success, 'User signed in');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'user_type' => "required|in:customer,merchant",
            'store_name' => 'exclude_if:user_type,"customer"|required|max:255',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $authUser = new User();
        $authUser->name = $input["name"];
        $authUser->email = $input["email"];
        $authUser->user_type = $input["user_type"];
        $authUser->password = $input["password"];

        if ($input["user_type"] == "merchant") {
            $authUser->store_name = $input["store_name"];
        }
        $authUser->save();

        $success['token'] =  $this->createUserToken($authUser);
        $success['name'] =  $authUser->name;

        return $this->sendResponse($success, 'User created successfully.');
    }

    private function createUserToken($authUser) {
        // delete old token if exists
        PersonalAccessToken::where('tokenable_id', $authUser->id)->delete();

        if ($authUser->user_type == "customer") {

            $token =  $authUser->createToken("customer_" . $authUser->id, [
                'cart:add', 'cart:update'
            ])->plainTextToken;
        } else if ($authUser->user_type == "merchant") {

            $token =  $authUser->createToken("merchant_" . $authUser->id, [
                'store:add', 'store:update', 'products:add', 'products:update'
            ])->plainTextToken;
        }

        return $token;
    }
}
