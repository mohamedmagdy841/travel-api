<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use HttpResponse;
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)){
            return $this->sendResponse([], 'The provided credentials are incorrect.', 422);
        }

        $device = substr($request->userAgent() ?? '', 0, 255);

        return $this->sendResponse([
            'user' => $user,
            'access_token' => $user->createToken($device)->plainTextToken
        ], 'You have logged in successfully');
    }
}
