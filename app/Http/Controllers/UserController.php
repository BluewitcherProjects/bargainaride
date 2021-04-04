<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    function index(Request $request)
    {
       
        if(!$request->mobile){
            $response = [
                'result' => false,
                'ResponseMsg' => "Please provide correct mobile number!"
            ];
        
             return response($response, 201);
        }
        $user= User::where('mobile', $request->mobile)->first();
         //print_r($request->mobile);
            if (!$user) {

                $new=new user();
                $new->mobile=$request->mobile;
                $new->otp=123456;//rand(111111,999999);
                $new->password= Hash::make('serajalam');
                $new->save();
                // return response([
                //     'message' => ['These credentials do not match our records.']
                // ], 404);
            }else{
                $user->otp=123456;//rand(111111,999999);
                $user->update();
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'result' => true,
                'ResponseMsg' => "OTP send successfully!"
            ];
        
             return response($response, 201);
    }


    function otpverify(Request $request)
    {
        if(!$request->mobile || !$request->otp){
            return response([
                'result' => false,
                'data'=>[],
                'token'=>null,
                'message' => 'Please provide Mobile and OTP.'
            ], 404);
        }
        $user= User::where('mobile', $request->mobile)->where('otp', $request->otp)->first();
         //print_r($request->mobile);
            if (!$user) {
                return response([
                    'result' => false,
                    'data'=>[],
                    'token'=>null,
                    'message' => 'Wrong OTP.'
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'result' => true,
                'data'=>[$user],
                'token'=>$token,
                'ResponseMsg' => "OTP verified successfully!"
            ];
        
             return response($response, 201);
    }

    function adduserdetail(Request $request)
    {
        // print_r($request);

        if(!($request->wpnum || $request->name ||$request->mobile || $request->email || $request->password)){
            $response = [
                'result' => false,
                'ResponseMsg' => "Please provide all data name, wpnum ,email ,password!"
            ];
        
             return response($response, 201);
        }
        $user= User::where('mobile', $request->mobile)->first();
         //print_r($request->mobile);
            if (!$user) {
                return response([
                    'result'=>false,
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            $user->name=$request->name;
            $user->wpnum=$request->wpnum;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->update();
        
            
        
            $response = [
                'result' => true,
                'data'=>[$user],
                'ResponseMsg' => "Saved Successfully!"
            ];
        
             return response($response, 201);

    }
    
}
