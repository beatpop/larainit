<?php

namespace App\Http\Controllers\Api\User;

use App\Utils\JwtUtil;
use App\Utils\ResponseContentUtil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    use JwtUtil;

    public function __construct()
    {
        $this->middleware(['auth:api', 'cors', 'jwt.auth'], ['except' => ['login']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['cellphone', 'password']);

        try {
            if (! $token = auth()->attempt($credentials)) {
                return ResponseContentUtil::error(401, '手机或密码有误');
            }
        } catch (JWTException $exception) {
            ResponseContentUtil::error(500, '系统有误！' . $exception->getMessage());
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->getCurrentUser();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->userLogout();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->refreshToken();
    }
}
