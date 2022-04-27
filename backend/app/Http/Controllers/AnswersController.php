<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewModels\Response;
use App\Models\UserAnswerModel;
use App\Models\AnswerModel;
use App\Models\ChoiceModel;
use App\Models\StatusModel;
use App\Models\CategoryUsedModel;
use App\Models\ConstantVariablesModel;
use App\Models\UserActivitiesModel;
use Auth;
use DB;

class AnswersController extends Controller
{
    private $response;
    private $lesson_statuses;
    public function __construct() {
        $this->response = new Response();
        $this->lesson_statuses = new ConstantVariablesModel();
    }
    
    public function create_answer(Request $request) {
        try {
            DB::beginTransaction();

            $answers = $request->progress;
            $answers_array = array();
            $status_id = 0;

            foreach ($answers as $answer) {
                $answer = (object) $answer;
                $choice = ChoiceModel::where([
                    'question_id' => $answer->question_id,
                    'choice_id' => $answer->choice_id
                ])->first();

                if ($choice) {
                    $check_answer = AnswerModel::where([
                        'choice_id' => $choice->choice_id
                    ])->first();
                    if ($check_answer) {

                        $status = StatusModel::where('code', $this->lesson_statuses->correct)->first();
                        $status_id = $status->status_id;
                    } else {
                        $status = StatusModel::where('code', $this->lesson_statuses->incorrect)->first();
                        $status_id = $status->status_id;
                    }
                }

                array_push($answers_array,
                    [
                        'category_id' => $answer->category_id,
                        'question_id' => $answer->question_id,
                        'user_id' => Auth::user()->user_id,
                        'choice_id' => $answer->choice_id,
                        'status_id' => $status_id
                    ]
                );
            }

            $create_user_answer = UserAnswerModel::upsert($answers_array, ['question_id', 'user_id'], ['choice_id', 'status_id']);

            $progress = StatusModel::where('code', $request->answer_status)->first();

            $create_answer = CategoryUsedModel::updateOrCreate(
                [
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->user_id
                ],
                [
                'question_id' => $request->current_question_id,
                'status_id' => $progress->status_id
                ]
            );

            if ($request->answer_status === $this->lesson_statuses->completed) {
                $user_activity = new UserActivitiesModel();
                $user_activity->user_id = Auth::user()->user_id;
                $user_activity->category_id = $create_answer->category_id;
                $user_activity->save();
            }
            
            $this->response->status_code = 1;
            $this->response->message = "success";
            $this->response->data = [
                "message" => "Submitted Succesfully!"
            ];

            DB::commit();

            return response()->json($this->response);
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex);
            $this->response->status_code = 0;
            $this->response->message = "error";
            $this->response->data = $ex;

            return response()->json($this->response);
        }
    }

    public function get_user_answer($id) {
        $user_answer = UserAnswerModel::where('user_id', $id)->get();

        $this->response->status_code = 0;
        $this->response->message = "success";
        $this->response->data = $user_answer;

        return response()->json($this->response);
    }

    public function get_result(Request $request) {
        $user_answer = UserAnswerModel::with('choice', 'status', 'question', 'question.answer', 'question.answer.choice')
        ->where([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id
        ])->get();

        $this->response->status_code = 0;
        $this->response->message = "success";
        $this->response->data = $user_answer;

        return response()->json($this->response);
    }
}
