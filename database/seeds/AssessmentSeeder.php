<?php

use App\Assessment;
use Illuminate\Database\Seeder;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assessment::create([          
            'user_id' => 1,
            'assessment_id' => 1,
            'questionaire_id' => 1,
            'is_suspect' => 0,    
        ]);
    }
}