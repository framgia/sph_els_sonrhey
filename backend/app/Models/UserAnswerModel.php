<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswerModel extends Model
{
    use HasFactory;

    protected $table = 'user_answers';
    protected $primaryKey = 'u_answer_id';
    protected $fillable = [
        'category_id',
        'question_id',
        'choice_id',
        'status_id',
        'user_id'
    ];
}
