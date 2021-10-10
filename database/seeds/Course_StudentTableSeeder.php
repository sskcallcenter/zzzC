<?php

use Illuminate\Database\Seeder;

class Course_StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course_student')->delete();

        DB::table('course_student')->insert([
          'course_id' => 1,
          'student_id' => 2
        ]);

        DB::table('course_student')->insert([
          'course_id' => 2,
          'student_id' => 2
        ]);
    }
}
