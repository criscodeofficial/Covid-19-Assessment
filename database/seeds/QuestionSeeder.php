<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([ 
            'questionaire_id' => 1, 
            'question' => 'Check the following if anything apply to you?',
            'require' => true
        ]);

        Question::create([ 
            'questionaire_id' => 1, 
            'question' => 'Do you fulfill one of the following?',
            'require' => true
        ]);

        Question::create([ 
            'questionaire_id' => 2, 
            'question' => 'Are you feeling one of the following symtoms: fever, cough, colds, sore throat, other respiratory symptoms?', 
            'require' => true     
        ]);

        Question::create([ 
            'questionaire_id' => 2, 
            'question' => 'Do you have the following symptoms?(Please, leave if none of these applies to you)?',
            'require' => false      
        ]);

        Question::create([ 
            'questionaire_id' => 2, 
            'question' => 'Which of these situation currently apply to you?', 
            'require' => true     
        ]);

        Question::create([ 
            'questionaire_id' => 2, 
            'question' => 'Do you have medical history or other reasons that might cause the present of virus?',
            'require' => true      
        ]);
    }
}
