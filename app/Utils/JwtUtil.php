<?php
/**
 * Created by PhpStorm.
 * User: DH
 * Date: 2019/2/26
 * Time: 21:43
 */

namespace App\Utils;

/**
 * Trait JwtUtil
 * @author Alex
 */
trait JwtUtil
{
    // token 过期时间（24小时）
    protected $expired_in = 24*60;

    /**
     * 获取当前登录用户
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getCurrentUser()
    {
        return ResponseContentUtil::success(auth()->user());
    }

    /**
     * 刷新token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function refreshToken()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * 登出
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function userLogout()
    {
        auth()->logout();
        return ResponseContentUtil::successMessage("成功登出!");
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return ResponseContentUtil::success([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL()
        ]);
    }
}