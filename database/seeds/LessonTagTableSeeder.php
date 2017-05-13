<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Lesson;
use App\Models\Tag;

class LessonTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker     = Faker::create();
        $lessonsId = Lesson::lists('id')->toArray();
        $tagsId    = Tag::lists('id')->toArray();

        foreach(range(1,10) as $index){
            DB::table('lesson_tag')->insert([
                'lesson_id' => $faker->randomElement($lessonsId),
                'tag_id'    => $faker->randomElement($tagsId)
            ]);
        }
    }
}
