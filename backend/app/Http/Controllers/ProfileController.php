<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewModels\Response;
use App\Models\User;
use Hash;
use Storage;
use Auth;

class ProfileController extends Controller
{
    private $response;
    public function __construct() {
        $this->response = new Response();
    }

    public function update_profile(Request $request){
        $fields = json_decode($request->fields);

        $user = Auth::user();
        foreach ($fields as $field) {
            if ($field->is_edited) {
                if ($field->name === "full_name") {
                    $user->full_name = $field->full_name;
                } else if ($field->name === "email_address") {
                    $user->email_address = $field->email_address;
                } else if ($field->name === "password") {
                    if (Hash::check($field->old_password, $user->password)) {
                        $user->password = bcrypt($field->new_password);
                    } else {
                        $this->response->status_code = 0;
                        $this->response->message = "error";
                        $this->response->data = "Incorrect Old password";

                        return response()->json($this->response);
                    }
                } else if ($field->name === "image") {
                    $image = $request->file('image');
                    $disk = Storage::disk('s3');
                    $uploaded_image = $disk->put($image, $image);
                    $str = str_replace('\\', '/', $uploaded_image);
                    $url = $disk->url($str);
                    $file_name = env('AWS_BUCKET').".".$url;

                    $user->avatar = $file_name;
                }
            } 
        }
        $user->save();

        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = $user;

        return response()->json($this->response);
    }
    //
}
