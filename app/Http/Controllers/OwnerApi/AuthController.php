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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [], [
            'name' => __('lang.name'),
            'email' => __('lang.email'),
            'password' => __('lang.password'),
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages()->messages());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
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
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ], [], [
            'email' => __('lang.email'),
            'password' => __('lang.password'),
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages()->messages());
        }

        // check if user hasn't verify account
        $validated = $validator->safe()->only(['password', 'email']);
        $user = User::where('email', $validated['email'])->first();
        if ($user?->type == UserType::OWNER && $user?->approval != UserApproval::APPROVED) {
            return $this->unAuthenticatedResponse(null, __('messages.owner_not_approved'));
        }

        if (Auth::guard('owner')->attempt(['email' => $request->email, 'password' => $request->password, 'type' => UserType::OWNER->value, 'approval' => UserApproval::APPROVED->value])) {
            $authUser = Auth::guard('owner')->user();
            $data['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $data['name'] =  $authUser->name;
            $data['email'] =  $authUser->email;
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
