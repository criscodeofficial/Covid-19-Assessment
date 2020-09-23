<?php

use App\Answer;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answer::create([ 
            'questionaire_id' => 1, 
            'question_id' => 1, 
            'answer' => 'Age 60 or above?',
        ]);

        Answer::create([
            'questionaire_id' => 1,
            'question_id' => 1, 
            'answer' => 'Person with pre-existing conditions(lung disease, diabetic, highblood, etc.?',
        ]);

        Answer::create([ 
            'questionaire_id' => 1,
            'question_id' => 1, 
            'answer' => 'Workers or friends with high exposure (e.g, enforcement units, healthcare worker, etc.?',
        ]);

        Answer::create([ 
            'questionaire_id' => 1,
            'question_id' => 1, 
            'answer' => 'None of these applies to me.',
        ]);

        Answer::create([ 
            'questionaire_id' => 1,
            'question_id' => 2, 
            'answer' => ' Security Guard',
        ]);

        Answer::create([ 
            'questionaire_id' => 1,
            'question_id' => 2, 
            'answer' => 'Barangay Tanod',
        ]);

        Answer::create([ 
            'questionaire_id' => 1,
            'question_id' => 2, 
            'answer' => 'Health Worker',
        ]);

        Answer::create([
            'questionaire_id' => 1, 
            'question_id' => 2, 
            'answer' => 'Law Enforcement',
        ]);

        Answer::create([
            'questionaire_id' => 1, 
            'question_id' => 2, 
            'answer' => 'None of these',
        ]);

        Answer::create([ 
            'questionaire_id' => 2, 
            'question_id' => 3, 
            'answer' => 'Yes, I am feeling one or more.',
        ]);

        Answer::create([ 
            'questionaire_id' => 2,
            'question_id' => 3, 
            'answer' => 'No, Im not feeling one of them.',
        ]);

        Answer::create([ 
            'questionaire_id' => 2,
            'question_id' => 4, 
            'answer' => 'Cough',
        ]);

        Answer::create([
            'questionaire_id' => 2, 
            'question_id' => 4, 
            'answer' => 'Colds',
        ]);

        Answer::create([ 
            'questionaire_id' => 2,
            'question_id' => 4, 
            'answer' => 'Sore Throat',
        ]);

        Answer::create([ 
            'questionaire_id' => 2,
            'question_id' => 4, 
            'answer' => 'Other symptoms',
        ]);


        Answer::create([ 
            'questionaire_id' => 2,
            'question_id' => 4, 
            'answer' => 'None of these',
        ]);

        Answer::create([
            'questionaire_id' => 2, 
            'question_id' => 5, 
            'answer' => ' Had contact with a confirmed or probable case of COVID-19.',
        ]);

        Answer::create([ 
            'questionaire_id' => 2,
            'question_id' => 5, 
            'answer' => 'Had travel history outside the country for the past few months?',
        ]);

        Answer::create([ 
            'questionaire_id' => 2,
            'question_id' => 5, 
            'answer' => 'Both cases do not apply to me.',
        ]);
   
        Answer::create([ 
            'questionaire_id' => 2,
            'question_id' => 6, 
            'answer' => 'Yes, I have.',
        ]);

        Answer::create([ 
            'questionaire_id' => 2,
            'question_id' => 6, 
            'answer' => ' No, I dont.',
        ]);   
    }
}
