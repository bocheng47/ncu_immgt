<?php

use Illuminate\Database\Seeder;

class WaiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('waivers')->delete();
        $d = Carbon\Carbon::now();
	    for ($i=0; $i < 10; $i++) {
	        \App\Waiver::create([
	            'title'   => $i."我是標題標題",
	            'create_date' => $d,
	            'filename' => 'test001.pdf'
	        ]);
	        $d->addDay();
	    }
    }
}
