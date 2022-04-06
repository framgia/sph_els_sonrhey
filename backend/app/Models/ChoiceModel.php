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

}
