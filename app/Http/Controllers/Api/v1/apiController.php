<?php
/**
 * Created by PhpStorm.
 * User: eDr
 * Date: 9/6/2017
 * Time: 12:51 PM
 */

namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;

class apiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic', ['only' => ['store', 'destroy']]);
    }

    protected $statusCode = 200 ;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data , $headers = [])
    {
        return response($data , $this->getStatusCode() , $headers);
    }

    public function respondWithError($description ,$message = 'no message set')// با استفاده از متود به راحتی مقدار کد وضعیت رو در قسمت دیتا هم قرار می دهیم
    {
        return $this->respond([
            'ok'=> false,
            'error_code'=>$this->getStatusCode(),
            'description'=> $description,
            'message'=> $message
        ]);
    }


    public function respondWithMessage($description ,$message = 'no message set')// با استفاده از متود به راحتی مقدار کد وضعیت رو در قسمت دیتا هم قرار می دهیم
    {
        return $this->respond([
            'ok'=> true,
            'error_code'=>$this->getStatusCode(),
            'description'=> $description,
            'message'=> $message
        ]);
    }

    public function respondTrue($result)
    {
        return $this->respond([
            'ok' => true,
            'result' => $result,
            'status' => $this->getStatusCode()

        ]);
    }



    //متدهایی برای ارورهای معروفی که خیلی بیشتر اتفاق خواهند افتاد

    public function RespondCreated($message, $statusCode = 201, $description = 'info created.')
    {
        $this->setStatusCode($statusCode);
        return $this->respondWithMessage($description, $message);

    }

    public function respondNotFound($description, $message = 'no message set')
    {
        $this->setStatusCode(404);
        return $this->respondWithError($description, $message);
    }

    public function respondInternalError($description = 'Internal Error', $message = 'no message set')
    {
        $this->setStatusCode(500);
        return $this->respondWithError($description, $message);
    }

    public function RespondDeleted($message)
    {
        $this->setStatusCode(202);
        return $this->respondTrue([
            'message' => $message
        ]);
    }

    public function respondValidationError($description = 'The server understood the request but refuses to authorize it.', $message = 'no message set')
    {
        $this->setStatusCode(403);
        return $this->respondWithError($description, $message);
    }

    public function respondBadRequest($description= 'Bad Request', $message = 'no message set')
    {
        $this->setStatusCode(400);
        return $this->respondWithError($description, $message);
    }

    public function respondSuccessMessage($description= 'The request has succeeded.', $message = 'no message set')
    {
        $this->setStatusCode(200);
        return $this->respondWithError($description, $message);
    }

    protected function getPaginationInfo($data)
    {
        return [
            'total' => $data->total(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'next_page_url' => $data->nextPageUrl(),
            'prev_page_url' => $data->previousPageUrl(),
            'limit' => $data->perPage()
        ];
    }


}