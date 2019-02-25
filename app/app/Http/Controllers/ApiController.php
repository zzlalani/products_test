<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * success response method with paging information
     *
     * @param $result
     * @param $max
     * @param $next
     * @param $last
     * @param $page
     * @param $path
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendPagedResponse($result, $max, $next, $last, $page, $path)
    {
        $response = [
            'links' => [
                'self' => url()->route($path, ['max' => $max, 'page' => $page]),
                'next' => url()->route($path, ['max' => $max, 'page' => $next]),
                'last' => url()->route($path, ['max' => $max, 'page' => $last]),
            ],
            'data'    => $result,
        ];


        return response()->json($response, 200);
    }

    /**
     * success response method.
     *
     * @param $result
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result = null, $message = null)
    {
        $response = [];

        if ($result) {
            $response['data'] = $result;
        }

        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @param array $error
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error = [], $code = 404)
    {
        $response = [
            'error' => $error,
        ];

        return response()->json($response, $code);
    }
}
