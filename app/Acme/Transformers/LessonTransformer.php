<?php


namespace App\Acme\Transformers;


class LessonTransformer extends Transformer{


    public function transform($lesson)
    {
        return [
            'title'     => $lesson['title'],
            'body'      => $lesson['body'],
            'published' => $lesson['created_at'],
        ];
    }
}