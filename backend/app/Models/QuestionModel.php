<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'question_id';
    protected $fillable = [
        'category_id',
        'description'
    ];

    public function category() {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'category_id');
    }

    public function choices() {
        return $this->hasMany(ChoiceModel::class, 'question_id', 'question_id');
    }

    public function answer() {
        return $this->hasOneThrough(AnswerModel::class, ChoiceModel::class, 'question_id', 'choice_id', 'question_id', 'choice_id');
    }
}
