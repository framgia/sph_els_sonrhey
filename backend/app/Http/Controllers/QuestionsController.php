<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewModels\Response;
use App\Models\QuestionModel;
use App\Models\ChoiceModel;
use App\Models\AnswerModel;
use DB;

class QuestionsController extends Controller
{
    private $response;
    public function __construct() {
        $this->response = new Response();
    }

    public function create_question(Request $request) {
        try {
            DB::beginTransaction();
            $question = new QuestionModel($request->all());
            $question->save();

            $choices = $request->choices;

            foreach ($choices as $choice) {
                $choice = (object) $choice;
                $create_choice = new ChoiceModel();
                $create_choice->question_id = $question->question_id;
                $create_choice->letter = $choice->letter;
                $create_choice->description = $choice->choiceDescription;
                $create_choice->save();
            }

            $find_answer = ChoiceModel::where([
                'letter' => $request->answer,
                'question_id' => $question->question_id
            ])->first();
            $answer = new AnswerModel();
            $answer->choice_id = $find_answer->choice_id;
            $answer->save();
            
            $this->response->status_code = 1;
            $this->response->message = "success";
            $this->response->data = $question;

            DB::commit();

            return response()->json($this->response);
        } catch (\Exception $ex) {
            DB::rollback();

            $this->response->status_code = 0;
            $this->response->message = "error";
            $this->response->data = $ex;

            return response()->json($this->response);
        }
    }

    public function get_questions() {
        $questions = QuestionModel::with('category', 'answer', 'answer.choice', 'choices')->paginate(5);
        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = $questions;

        return response()->json($this->response);
    }

    public function edit_question(Request $request) {
        try {
            DB::beginTransaction();

            $questions = QuestionModel::find($request->question_id);
            $questions->category_id = $request->category_id;
            $questions->description = $request->description;
            $questions->save();

            $choices = $request->choices;
            foreach ($choices as $choice) {
                $choice = (object) $choice;
                $choice_update = ChoiceModel::find($choice->choice_id);
                $choice_update->description = $choice->description;
                $choice_update->save();
            }
            
            $answer = (object) $request->answer;
            $answer_update = AnswerModel::find($answer->answer_id);
            $answer_update->choice_id = $answer->choice_id;
            $answer_update->save();

            $this->response->status_code = 1;
            $this->response->message = "success";
            $this->response->data = $questions;

            DB::commit();

            return response()->json($this->response);
        } catch (\Exception $ex) {
            DB::rollback();

            $this->response->status_code = 0;
            $this->response->message = "error";
            $this->response->data = $ex;

            return response()->json($this->response);
        }
    }

    public function delete_question(Request $request) {
        $questions = QuestionModel::find($request->question_id);
        $questions->answer()->delete();
        $questions->choices()->delete();
        $questions->delete();

        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = [
            "message" => "Deleted Successuly."
        ];

        return response()->json($this->response);
    }
}
