<?php

namespace App\Http\Controllers;

use App\Models\ConstantVariablesModel;
use Illuminate\Http\Request;
use App\Models\ViewModels\Response;
use App\Models\UserRelationshipModel;
use DB;
use Auth;
use App\Models\User;
use App\Models\UserActivitiesModel;

class FollowingController extends Controller
{
    private $response;
    private $constant;
    public function __construct() {
        $this->response = new Response();
        $this->constant = new ConstantVariablesModel();
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
            DB::beginTransaction();

            $my_id = Auth::user()->user_id;

            $user_relationship = new UserRelationshipModel();
            $user_relationship->following_id = $request->following_id;
            $user_relationship->followed_id = $my_id;
            $user_relationship->save();

            $user_activity = new UserActivitiesModel();
            $user_activity->user_id = Auth::user()->user_id;
            $user_activity->user_relationship_id = $user_relationship->user_relationship_id;
            $user_activity->save();

            $this->response->status_code = 1;
            $this->response->message = "success";
            $this->response->data = "Followed Successfuly!";

            DB::commit();
            return response()->json($this->response);
        } catch (\Exception $ex) {
            DB::rollback();
            
            $this->response->status_code = 0;
            $this->response->message = "error";
            $this->response->data = "Data Error";

            return response()->json($this->response);
        }
    }

    public function user_list() {
        $user_id = Auth::user()->user_id;
        $users = User::with('following', 'followed')->whereHas('role', function ($role) {
            $role->where('code', $this->constant->student);
        })
        ->where('user_id', '<>', $user_id)
        ->paginate(5);
        $users->setPath('');

        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = $users;

        return response()->json($this->response);
    }

    public function unfollow(Request $request) {
        try {
            $unfollow = UserRelationshipModel::where([
            'followed_id' => $request->followed_id,
            'following_id' => $request->following_id
            ])->first();
                
            $unfollow->user_activity()->delete();
            $unfollow->delete();
    
            $this->response->status_code = 1;
            $this->response->message = "success";
            $this->response->data = "Unfollowed Successfuly!";
        } catch(\Exception $ex) {
            $this->response->status_code = 0;
            $this->response->message = $ex;
        }

        return response()->json($this->response);
    }
    //
}
