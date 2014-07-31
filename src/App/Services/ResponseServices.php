<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 7/31/14
 * Time: 10:28 AM
 */

namespace App\Services;


class ResponseServices implements ResponseInterface {

    public static function respond($data, $message)
    {
        return ['data' => $data, 'message' => $message];
    }
} 