<?php

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * @var array
     */
    private $tableNames = [
        'lessons',
        'tags',
        'lesson_tag'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();


        $this->call(LessonsTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(LessonTagTableSeeder::class);
    }

    public function cleanDatabase()
    {
        //To tackle 1701
        // cannot truncate a table refrenced in foreign key constraint error

        //Resetting foreign_key_checks flag to 0 before truncating
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach($this->tableNames as $table){
            DB::table($table)->truncate();
        }

        //Setting the foreign_key_checks flag to 1 after truncation
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
