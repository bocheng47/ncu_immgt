<?php

use Illuminate\Database\Seeder;

class GoodpaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course_goodpapers')->delete();
	    for ($i=0; $i < 10; $i++) {
	        \App\Goodpaper::create([
	        	'acadYear' => 100 + $i,
	            'title'   => "博士班 某某某某",
	            'filename' => 'test001.pdf'
	        ]);
	    }
    }
}
