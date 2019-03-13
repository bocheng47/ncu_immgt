<?php

use Illuminate\Database\Seeder;

class DoubleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course_doubles')->delete();
        for ($i=0; $i < 10; $i++) {
            \App\Double::create([
                'filename' =>   'Curriculum-of-Plan-of-Study-for-32-Degree-Program-IM課程抵免建議表.pdf'
            ]);
        }
    }
}
