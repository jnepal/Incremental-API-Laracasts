<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Acme\Transformers\TagTransformer;
use App\Models\Tag;

class TagsController extends ApiController
{
    protected $tagsTransformer;

    /**
     * TagsController constructor.
     * @param $tagsTransformer
     */
    public function __construct(TagTransformer $tagsTransformer)
    {
        $this->tagsTransformer = $tagsTransformer;
    }

    public function index($lessonId = Null){
        $tags = $this->getTags($lessonId);

        if(!$tags){
            return $this->respondNotFound('Tags not found');
        }

        return $this->respond([
            'data' => $this->tagsTransformer->transformCollection($tags->toArray())
        ]);
    }

    public function show(){

    }

    /**
     * @param $lessonId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTags($lessonId)
    {
        return ($lessonId) ? Lesson::findOrFail($lessonId)->tags : Tag::all();
    }
}
