<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewModels\Response;
use App\Models\UserRelationshipModel;
use DB;
use Auth;
use App\Models\User;

class FollowingController extends Controller
{
    private $response;
    public function __construct() {
        $this->response = new Response();
    }

    public function get_user_relationship() {
        $usr = UserRelationshipModel::all();
        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = $usr;

        return response()->json($this->response);
    }

    public function follow_user(Request $request) {
        try {
            $my_id = Auth::user()->user_id;

            $user_relationship = new UserRelationshipModel();
            $user_relationship->following_id = $request->following_id;
            $user_relationship->followed_id = $my_id;
            $user_relationship->save();

            $this->response->status_code = 1;
            $this->response->message = "success";
            $this->response->data = "Followed Successfuly!";

            return response()->json($this->response);
        } catch (\Exception $ex) {
            $this->response->status_code = 0;
            $this->response->message = "error";
            $this->response->data = "Data Error";

            return response()->json($this->response);
        }
    }

    public function user_list() {
        $users = User::all();
        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = $users;

        return response()->json($this->response);
    }
    //
}
