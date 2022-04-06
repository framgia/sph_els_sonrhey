<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerModel extends Model
{
    use HasFactory;

    protected $table = 'answers';
    protected $primaryKey = 'answer_id';
    protected $fillable = [
        'choice_id'
    ];
}
