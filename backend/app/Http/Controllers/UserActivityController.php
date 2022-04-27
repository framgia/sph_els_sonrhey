<?php

namespace App\Http\Controllers;

use App\Models\CategoryUsedModel;
use App\Models\ConstantVariablesModel;
use App\Models\UserActivitiesModel;
use App\Models\ViewModels\Response;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\UserAnswerModel;
use App\Models\UserRelationshipModel;

class UserActivityController extends Controller
{
    private $response;
    private $lesson_statuses;
    public function __construct() {
        $this->response = new Response();
        $this->lesson_statuses = new ConstantVariablesModel();
    }

    public function get_user_activities() {
        $user_relationship_query = [];
        $category_used_query = [];

        $user_relationship = UserRelationshipModel::orWhere([
            "following_id" => Auth::user()->user_id,
            "followed_id" => Auth::user()->user_id
            ])
        ->get(['user_relationship_id', 'following_id', 'followed_id']);

        if (count($user_relationship)) {
            $user_relationship_query = $user_relationship->pluck('user_relationship_id')->all();
            
            $other_user_id_following = $user_relationship->pluck('following_id')->all();
            $other_user_id_followed = $user_relationship->pluck('followed_id')->all();

            $category_used = CategoryUsedModel::whereIn('user_id', $other_user_id_following)->whereIn('user_id', $other_user_id_followed)->get(['user_id']);

            $category_used_query = $category_used->pluck('user_id')->all();
        }

        $user_activities = UserActivitiesModel::with('user', 'user_relationship', 'user_relationship.following', 'user_relationship.followed_back', 'category')
        ->orWhere('user_id', Auth::user()->user_id)
        ->orWhereIn('user_id', $category_used_query)
        ->orWhereIn('user_relationship_id', $user_relationship_query)
        ->orderBy('user_activity_id', 'DESC')->paginate(5);

        $user_activities->setPath(url()->current().'/');

        $this->response->status_code = 1;
        $this->response->message = 'success';
        $this->response->data = $user_activities;
        
        return response()->json($this->response);
    }

    public function get_my_activities() {
        $user_id = Auth::user()->user_id;

        $user_activities = UserActivitiesModel::with('user', 'followed_by_user.following', 'category')
        ->where('user_id', $user_id)
        ->orderBy('user_activity_id', 'DESC')
        ->paginate(5);

        $user_activities->setPath(url()->current().'/');

        $this->response->status_code = 1;
        $this->response->message = 'success';
        $this->response->data = $user_activities;
        
        return response()->json($this->response);
    }

    public function get_my_followers() {
        $user_id = Auth::user()->user_id;

        $user = User::with('following', 'following.followed_back', 'followed', 'followed.following')->where('user_id', $user_id)->first();

        $this->response->status_code = 1;
        $this->response->message = 'success';
        $this->response->data = $user;
        
        return response()->json($this->response);
    }

    public function get_user_activities_by_user(Request $request) {
        $user = User::with('role', 'following', 'followed', 'category', 'category.status')
        ->whereHas('category.status', function($query) {
            $query->where('code', $this->lesson_statuses->completed);
        })
        ->where('user_id', $request->user_id)->first();

        if (!$user) {
            $user = User::with('role', 'following', 'following.followed_back', 'followed', 'followed.following', 'category', 'category.status')->where('user_id', $request->user_id)->first();
        }

        $user_activities = UserActivitiesModel::with('user', 'followed_by_user.following', 'category_by_user')
        ->where('user_id', $request->user_id)
        ->orderBy('user_activity_id', 'DESC')
        ->paginate(5);

        $user_activities->setPath(url()->current().'/');

        $this->response->status_code = 1;
        $this->response->message = 'success';
        $this->response->data = [
            "user" => $user,
            "user_activity" => $user_activities
        ];
        
        return response()->json($this->response);
    }

    public function get_my_learnings() {
        $user_id = Auth::user()->user_id;

        $questions_answered = UserAnswerModel::with('status')->whereHas('status', function($query) {
            $query->where('code', $this->lesson_statuses->correct);
        })->where('user_id', $user_id)->count();

        $categories_finished = CategoryUsedModel::with('status')->whereHas('status', function($query) {
            $query->where('code', $this->lesson_statuses->completed);
        })->where('user_id', $user_id)->count();

        $this->response->status_code = 1;
        $this->response->message = 'success';
        $this->response->data = [
            "questions_answered" => $questions_answered,
            "categories_finished" => $categories_finished
        ];
        
        return response()->json($this->response);
    }

}
