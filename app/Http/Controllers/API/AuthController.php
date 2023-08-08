<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Controllers\API\APIResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\API\LoginUserRequest;
use App\Http\Requests\API\CreateUserRequest;
use App\Http\Requests\API\UpdateProfileRequest;
use App\Http\Requests\API\ForgetPasswordRequest;
use App\Http\Requests\API\UpdatePasswordRequest;
use Illuminate\Validation\ValidationException;

    class AuthController extends Controller
{
    use APIResponse;
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(CreateUserRequest $request)
    {

        $user = User::create($request->validated());
        if ($user) {
            $data = ['token' => $user->createToken("API TOKEN")->plainTextToken];
            return $this->APIResponse($data, null, 200, true, 'User Created Successfully');
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(LoginUserRequest $request)
    {
      
        $emailOrPhone = filter_var($request->emailOrPhone,FILTER_VALIDATE_EMAIL)? 'email':'phone';
        if (!Auth::attempt([$emailOrPhone => $request->emailOrPhone, 'password' => $request->password, 'type' => 0])) {
            return $this->APIResponse(null, ['login_failed' => $emailOrPhone == 'email'? __('lang.login_email_failed'):__('lang.login_phone_failed')], 401, false, 'Unauthorized error');
        }
        $user = User::where( $emailOrPhone , $request->emailOrPhone)->first();
        return $this->APIResponse(['token' => $user->createToken("API TOKEN")->plainTextToken], null, 200, true, 'User Logged In Successfully');
    }





    public function userProfile(Request $request)
    {
        $bearerToken = $request->token;
        $token = PersonalAccessToken::findToken($bearerToken);
        if (!$token) {
            return $this->APIResponse(null, null, 404, false, 'Token not found');
        }
        $user = $token->tokenable;
        return $this->APIResponse(new UserResource($user), null, 200, true, 'User profile data');
    }



    public function getFcmToken(Request $request)
    {

        $bearerToken = $request->token;
        $token = PersonalAccessToken::findToken($bearerToken);
        if (!$token) {
            return $this->APIResponse(null, null, 404, false, 'Token not found');
        }
        $user = $token->tokenable;

        $user->update([
            'fcm_token' => $request->fcm_token
        ]);

        return $this->APIResponse('', null, 200, true, 'Token captured , thank you ! ^_^');
    }

    public function updatePassword(UpdatePasswordRequest $request){
       
        $bearerToken = $request->token;
        $token = PersonalAccessToken::findToken($bearerToken);
        if (!$token) {
            return $this->APIResponse(null, null, 404, false, 'Token not found');
        }
        $user = $token->tokenable;
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password'=>$request->password,
                ]);
           }else{
            return $this->APIResponse(null, ['current_password'=>__('auth.password')], 403 , false, 'Validation errors !');
           }

        return $this->APIResponse(new UserResource($user), null, 200, true, 'Password updated successfully !');
    }

    public function updateProfile(UpdateProfileRequest $request){
        $bearerToken = $request->token;
        $token = PersonalAccessToken::findToken($bearerToken);
        if (!$token) {
            return $this->APIResponse(null, null, 404, false, 'Token not found');
        }
        $user = $token->tokenable;
        $user->update([
        'name'=>$request->name,
        'email'=>$request->email,
        ]);
        return $this->APIResponse(new UserResource($user), null, 200, true, 'Profile updated successfully !');
    }

    public function forgetPassword(ForgetPasswordRequest $request){
        
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return $this->APIResponse(null, null, 200, true, __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
       
    }
}
