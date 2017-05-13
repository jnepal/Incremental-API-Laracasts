<?php

namespace App\Http\Controllers;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller{

    /**
     * @var int
     */
    protected $statusCode = 200;

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

        return $this;
    }

    public function respondNotFound($message = "Not Found"){
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondInternalError($message = "Internal Error"){
        return $this->setStatusCode(500)->respondWithError($message); 
    }

    public function respond($data, $headers = []){
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $lessonsArray
     * @param $lessons
     * @return mixed
     */
    protected function respondWithPagination(Paginator $lessons, $data)
    {
        $data = array_merge($data, [

            'paginator' => [
                'total_page' => ceil($lessons->total() / $lessons->perPage()),
                'current_page' => $lessons->currentPage(),
                'limit' => $lessons->perPage(),

            ]
        ]);

        return $this->setStatusCode(200)->respond($data);
    }

    public function respondWithError($message){
        return $this->respond([
            'error'=> [
                'message'     => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondCreated($message)
    {
        return $this->setStatusCode(201)->respond([
            'message' => $message
        ]);
    }

    /**
     * @return mixed
     */
    public function respondValidationError()
    {
        return $this->setStatusCode(422)
            ->respondWithError('Parameters Failed Validation');
    }
}
