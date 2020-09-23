<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Questionaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function storeAnswer(Questionaire $questionaire, Request $request) {

        // assign variable coming from vue js page
        $questionId = $request['questionId'];
        $answerId   = $request['answerId'];
        $questionaireId    = $request['questionaireId'];
        $userId   = auth()->user()->id;
        $assessmentId   = auth()->user()->id;
        $form = $request['formData'];


        // store assessment in db
        $assessment = Assessment::create([     

            'user_id' => auth()->user()->id,
            'assessment_id' => auth()->user()->id,
            'questionaire_id' => $request['formData.fieldQuestionaire'],
            'is_suspect' => $request['formData.is_suspect'],
            'question_id' => $request['formData.fieldQuestion'],      
    
        ]);
        
        // store assessment response in db
        $response = $assessment->responses()->firstOrCreate([
            'user_id' => auth()->user()->id,
            'assessment_id' => auth()->user()->id,
            'questionaire_id' => $request['formData.fieldQuestionaire'],
            'question_id' => $request['formData.fieldQuestion'],
            'answer(s)' =>  $request['answer'],
            'answer_id' =>  json_encode($request['formData.answer_id']),
        ]);
        
        // count is_suspect if greater than 2 will be consider (1 == true)
        $count = $assessment->where('is_suspect', 1)->count();
        
        if($response->question_id) {
            if($count > 2) {
                return response()->json([
                    'status' => true,
                    'message_1' => 'Your are consider as suspect of Covid-19',
                    'count' => $count
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message_2' => 'You are not consider as suspect of Covid-19',
                    'count' => $count
                ]);
            }
        }   
    }

    public function getResult(Questionaire $questionaire, Request $request)
    {   
      
        $assessment = DB::table('assessment_responses')
            ->where('assessment_id', '=', auth()->user()->id)
            ->get(['answer_id', 'answer(s)']);
        
            return response()->json($assessment);
       
    }
}
