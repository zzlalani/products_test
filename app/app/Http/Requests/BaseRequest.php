<?php
/**
 * @see https://hackernoon.com/always-return-json-with-laravel-api-870c46c5efb2
 */

namespace App\Http\Requests;

use Illuminate\Http\Request;

class BaseRequest extends Request
{

    /**
     * @return bool
     */
    public function expectsJson()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function wantsJson()
    {
        return true;
    }
}
