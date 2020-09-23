<?php

use App\Questionaire;
use Illuminate\Database\Seeder;

class QuestionaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Questionaire::create([  
            'title' => 'This is the first questionaire.',
            'purpose' => 'This is the purpose of this questionare 1',
        ]);

        Questionaire::create([  
            'title' => 'This is the second questionaire.',
            'purpose' => 'This is the purpose of this questionare 2',
        ]);
    }
}
