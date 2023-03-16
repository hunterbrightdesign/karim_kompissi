<?php


namespace App\Http\Controllers\Api\v1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class HelpController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'statusText' => 'success',
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'statusText' => 'failure',
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    /**
     * return bool response.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkUsercreatedQuiz(int $Quiz_id)
    {
    }

}
