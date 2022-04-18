<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewModels\Response;
use App\Models\CategoryModel;

class CategoriesController extends Controller
{
    private $response;
    public function __construct() {
        $this->response = new Response();
    }

    public function create_category(Request $request) {
        $create_category = new CategoryModel($request->all());
        $create_category->save();

        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = $create_category;

        return response()->json($this->response);
    }

    public function edit_category(Request $request) {
        $create_category = CategoryModel::find($request->category_id);
        $create_category->title = $request->title;
        $create_category->name = $request->name;
        $create_category->save();

        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = $create_category;

        return response()->json($this->response);
    }

    public function delete_category(Request $request) {
        $create_category = CategoryModel::destroy($request->category_id);

        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = "Deleted Successfuly";

        return response()->json($this->response);
    }

    public function get_category() {
        $get_category = CategoryModel::all();

        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = $get_category;

        return response()->json($this->response);
    }

    public function get_category_with_questions() {
        $get_categories = CategoryModel::with('questions', 'questions.choices')->get();

        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = $get_categories;

        return response()->json($this->response);
    }
    //
}
