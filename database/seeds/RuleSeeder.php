<?php

use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->delete();
        $acadType = array("大學部", "碩士班", "博士班", "碩士在職專班");
		$year = 100;
	    for ($i=0; $i < 40; $i++) {
	        \App\Rule::create([
	        	'acadYear' => $year,
	        	'acadType' => $i%4,
	            'title'   => $year.' 學年度 '.$acadType[$i%4].' 修業規定',
	            'filename' => 'test001.pdf'
	        ]);
	        if ($i%4 == 3) {
	        	$year++;
	        }
	    }
    }
}
