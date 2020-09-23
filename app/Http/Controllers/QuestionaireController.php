<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Assessment;
use App\Questionaire;
use App\AssessmentResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionaireController extends Controller
{
    
    public function consent(Questionaire $questionaire) {
       
        // loop questionaire to get all questions
        foreach($questionaire->all() as $questionaire) {
           
            foreach($questionaire->questions as $question) {
                
                $questions = $question->with('answers')->get();

                return response()->json($questions);
            }
        }
    }
}
