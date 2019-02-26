<?php
/**
 * Created by PhpStorm.
 * User: DH
 * Date: 2019/2/25
 * Time: 0:30
 */

namespace App\Utils;

use Illuminate\Http\Response;

/**
 * 返回数据返回统一格式
 *
 * @author Alex
 */
class ResponseContentUtil
{
    public static function success($result = null) {
        return response()
            ->json(["status" => 200, "message" => "成功！", "result" => $result],  Response::HTTP_OK);
    }

    public static function successMessage($message = "success", $result = null) {
        return response()
            ->json(["status" => 200, "message" => $message, "result" => $result],  Response::HTTP_OK);
    }

    public static function error($status = 500, $message)
    {
        return response()->json(["status" => $status, "message" => $message],  $status);
    }
}
