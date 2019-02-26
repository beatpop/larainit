<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

/**
 * JWT TOKEN 中间件
 * @author Alex
 */
class AuthJwt extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // return $next($request);
        try {
            // 如果用户登陆后的所有请求没有jwt的token抛出异常
            $user = JWTAuth::toUser($request->input('token'));
            if (! $user) {
                return response()->json(["status" => 404, "message" => '无该用户']);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(["status" => 401, "message" => 'Token 无效']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(["status" => 401, "message" => 'Token 已过期']);
            }else{
                return response()->json(["status" => 500, "message" => '出错了']);
            }
        }

        return $next($request);
    }
}
