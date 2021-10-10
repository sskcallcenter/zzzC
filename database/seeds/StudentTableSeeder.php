<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = new \App\Models\Student([
            'name' => '山田'
            ]);
            $student->save();

            // 2レコード
            $student = new \App\Models\Student([
            'name' => '吉岡'
            ]);
            $student->save();
    }
}
