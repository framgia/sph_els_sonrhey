<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewModels\Response;
use App\Models\UserAnswerModel;
use App\Models\AnswerModel;
use App\Models\ChoiceModel;
use App\Models\StatusModel;
use App\Models\CategoryUsedModel;
use Auth;
use DB;

class AnswersController extends Controller
{
    private $response;
    public function __construct() {
        $this->response = new Response();
    }
    
    public function create_answer(Request $request) {
        try {
            DB::beginTransaction();

            $answers = $request->progress;
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
                        $status = StatusModel::where('code', 'CRR')->first();
                        $status_id = $status->status_id;
                    } else {
                        $status = StatusModel::where('code', 'IRR')->first();
                        $status_id = $status->status_id;
                    }
                }

                $create_answer = new UserAnswerModel();
                $create_answer->category_id = $answer->category_id;
                $create_answer->question_id = $answer->question_id;
                $create_answer->choice_id = $answer->choice_id;
                $create_answer->user_id = Auth::user()->user_id;
                $create_answer->status_id = $status_id;
                $create_answer->save();
            }

            $progress = StatusModel::where('code', 'CMP')->first();

            $category_used = new CategoryUsedModel();
            $category_used->category_id = $request->category_id;
            $category_used->question_id = $request->current_question_id;
            $category_used->status_id = $progress->status_id;
            $category_used->user_id = Auth::user()->user_id;
            $category_used->save();

            $this->response->status_code = 1;
            $this->response->message = "success";
            $this->response->data = [
                "message" => "Submitted Succesfully!"
            ];

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
}
