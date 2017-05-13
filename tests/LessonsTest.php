<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Lesson;

class LessonsTest extends ApiTester{
    /** @test **/
    public function it_fetches_lessons(){

        //arrange
        $this->times(5)->makeLessons();

        //act
        $this->getJson('api/v1/lessons');

        //assert
        $this->assertResponseOk();
    }

    private function makeLessons($lessonFields = []){
        $lesson = array_merge([
            'title' => $this->faker->sentence(),
            'body'  => $this->faker->paragraph(),
        ], $lessonFields);

        while($this->times--){
            Lesson::create($lesson);
        }
    }

}
