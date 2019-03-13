<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Activity;

class ActivityTableSeeder extends Seeder
{
    public function run()
   {
        
        DB::table('activities')->truncate();
        for ($i=0 ; $i<10 ; $i++){
        	Activity::create([
              'activityname'=>str_random(10),
              'class'=>str_random(3),
              'picture'=>str_random(10)
        	]);
        }
    }
}