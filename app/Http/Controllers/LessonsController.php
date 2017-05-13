<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Acme\Transformers\LessonTransformer;
use Illuminate\Support\Facades\Input;

class LessonsController extends ApiController{

    protected $lessonTransformer;

    /**
     * LessonsController constructor.
     * @param $lessonTransformer
     */
    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
//        $this->middleware('auth', ['only' => 'store']);
    }


    public function index(){


        $limit = Input::get('limit')? Input::get("limit"): 5;

        //Limit provided must be less than or equal to 10
        if($limit >10){
            $limit = 5;
        }
        $lessons =  Lesson::paginate($limit);

        //Temporary Hack
        $lessonsArray = $lessons->toArray();


        return $this->respondWithPagination($lessons, [
            'data' => $this->lessonTransformer->transformCollection($lessonsArray['data']),
        ]);
    }

    public function show($id){

        $lesson = Lesson::find($id);

        if(!$lesson){
            return $this->respondNotFound('Lesson Not Found');
        }

        return $this->setStatusCode(200)->respond([
            'data' => $this->lessonTransformer->transform($lesson)
        ]);
    }

    public function store (Request $request){

        if(!$request->input('title') ||  !$request->input('body')){
            return $this->respondValidationError();
        }

        Lesson::create($request->all());

        return $this->respondCreated("Lessons Created");
    }


}
