<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChoiceModel extends Model
{
    use HasFactory;

    protected $table = 'choices';
    protected $primaryKey = 'choice_id';
    protected $fillable = [
        'question_id',
        'letter',
        'description'
    ];

    public function answer() {
        return $this->hasOne(AnswerModel::class, 'choice_id', 'choice_id');
    }

    public function questions() {
        return $this->belongsTo(QuestionModel::class, 'question_id', 'question_id');
    }
}
