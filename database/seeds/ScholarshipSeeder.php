<?php

use Illuminate\Database\Seeder;

class ScholarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course_scholarships')->delete();
	    for ($i=0; $i < 10; $i++) {
	        \App\Scholarship::create([
	        	'acadtype' => $i % 7,
	            'title'   => "博士班研究生獎助學金辦法(自107學年度入學之新生適用)",
	            'filename' => 'test001.pdf'
	        ]);
	    }
    }
}
