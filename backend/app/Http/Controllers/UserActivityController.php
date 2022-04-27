<?php

namespace App\Http\Controllers;

use App\Models\CategoryUsedModel;
use App\Models\UserActivitiesModel;
use App\Models\ViewModels\Response;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\UserAnswerModel;

class UserActivityController extends Controller
{
    private $response;
    public function __construct() {
        $this->response = new Response();
    }

    public function get_user_activities() {
        $user_activities = UserActivitiesModel::with('user', 'user_relationship', 'user_relationship.following', 'user_relationship.followed_back', 'category')->orderBy('user_activity_id', 'DESC')->get();

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
        ->get();

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
            $query->where('code', 'CMP');
        })
        ->where('user_id', $request->user_id)->first();

        if (!$user) {
            $user = User::with('role', 'following', 'following.followed_back', 'followed', 'followed.following', 'category', 'category.status')->where('user_id', $request->user_id)->first();
        }

        $user_activities = UserActivitiesModel::with('user', 'followed_by_user.following', 'category_by_user')
        ->where('user_id', $request->user_id)
        ->orderBy('user_activity_id', 'DESC')
        ->get();

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
            $query->where('code', 'CRR');
        })->where('user_id', $user_id)->count();

        $categories_finished = CategoryUsedModel::with('status')->whereHas('status', function($query) {
            $query->where('code', 'CMP');
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
