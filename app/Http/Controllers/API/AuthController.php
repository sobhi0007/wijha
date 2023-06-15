<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Resources\UserResource;
use App\Http\Controllers\API\APIResponse;
use App\Http\Requests\API\CreateUserRequest;
use App\Http\Requests\API\LoginUserRequest;

class AuthController extends Controller
{
    use APIResponse ;
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(CreateUserRequest $request)
    {
         
        $user = User::create($request->validated());
        if($user){
            $data = ['token'=> $user->createToken("API TOKEN")->plainTextToken];
            return $this->APIResponse( $data,null,200 , true ,'User Created Successfully');
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(LoginUserRequest $request)
    {
            if(!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'type' => 0]) ) {
                return $this->APIResponse(null, ['login_failed'=>__('lang.login_failed')] , 401 , false , 'Unauthorized error' );
            }
            $user = User::where('email',$request->email)->first();
            return $this->APIResponse(['token' => $user->createToken("API TOKEN")->plainTextToken], null , 200 , true , 'User Logged In Successfully' );
    }





    public function userProfile(Request $request)
    {
            $bearerToken = $request->token;
            $token = PersonalAccessToken::findToken($bearerToken);
            if (!$token) {
                return $this->APIResponse(null , null , 404 , false ,'Token not found');
            }
            $user = $token->tokenable;
            return $this->APIResponse( new UserResource($user) , null , 200 , true ,'User profile data');
    }
    
    
    
    public function getFcmToken(Request $request){
        
         $bearerToken = $request->token;
            $token = PersonalAccessToken::findToken($bearerToken);
            if (!$token) {
                return $this->APIResponse(null , null , 404 , false ,'Token not found');
            }
            $user = $token->tokenable;
            
            $user->update([
                'fcm_token'=>$request->fcm_token
                ]);
            
            return $this->APIResponse( '' , null , 200 , true ,'Token captured , thank you ! ^_^');
    }
    
    
    
}