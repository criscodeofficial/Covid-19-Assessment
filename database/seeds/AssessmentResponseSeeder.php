<?php

use App\AssessmentResponse;
use Illuminate\Database\Seeder;

class AssessmentResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssessmentResponse::create([
            'user_id' => 1,
            'assessment_id' => 1,
            'questionaire_id' => 1, 
            'question_id' => 1, 
            'answer_id' => 1,
            'answer(s)' => 'This is the answer.',
        ]);
    }
}
