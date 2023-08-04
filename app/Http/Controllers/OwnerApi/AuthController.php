<?php

namespace App\Http\Controllers\OwnerApi;

use App\Models\User;
use App\Enums\UserType;
use App\Enums\UserApproval;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\UpdateOwnerProfileRequest;
use App\Http\Resources\Owner\OwnerResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required',  'min:11' ,'max:20', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [], [
            'name' => __('lang.name'),
            'email' => __('lang.email'),
            'phone' => __('lang.phone'),
            'password' => __('lang.password'),
            'password_confirmation' => __('lang.password_confirmation'),
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages()->messages());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'type' => UserType::OWNER,
            'approval' => UserApproval::PENDING,
        ]);

        if ($user) {
            return $this->ApiSuccessResponse(null, __('messages.owner_registered'));
        }
    }

    public function login(Request $request)
    {

        if( filter_var($request->get('emailOrPhone'),FILTER_VALIDATE_EMAIL)){
            $rules= [
                'emailOrPhone' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ];
        }else{
            $rules= [
                'emailOrPhone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
                'password' => ['required', 'string'],
            ];
        }

        $validator = Validator::make($request->all(), 
        $rules,
        [], [
            'emailOrPhone' => __('lang.emailOrPhone'),
            'password' => __('lang.password'),
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages()->messages());
        }

        $emailOrPhone = filter_var($request->emailOrPhone,FILTER_VALIDATE_EMAIL)? 'email':'phone';
        // check if user hasn't verify account
        $user = User::where($emailOrPhone, $request->emailOrPhone)->first();
        if ($user?->type == UserType::OWNER && $user?->approval != UserApproval::APPROVED) {
            return $this->unAuthenticatedResponse(null, __('messages.owner_not_approved'));
        }


        if (Auth::guard('owner')->attempt([$emailOrPhone => $request->emailOrPhone, 'password' => $request->password, 'type' => UserType::OWNER->value, 'approval' => UserApproval::APPROVED->value])) {
            $authUser = Auth::guard('owner')->user();
            $data['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $data['name'] =  $authUser->name;
            $data['email'] =  $authUser->email;
            $data['phone'] =  $authUser->phone;
            return $this->ApiSuccessResponse($data, __('messages.loggedin_successfully'));
        } else {
            return $this->unAuthenticatedResponse(null, __('auth.failed'));
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->ApiSuccessResponse(null, __('messages.loggedout_successfully'));
    }

    public function profile(UpdateOwnerProfileRequest $request)
    {
        $data = $request->validated();
        if (isset($data['new_password'])) $data['password'] = $data['new_password'];
        $success = $request->user()->update($data);
        if ($success) return $this->updatedResponse(new OwnerResource($request->user()));
    }
}
