<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstantVariablesModel extends Model
{
    use HasFactory;

    public $completed = "CMP";
    public $correct = "CRR";
    public $incorrect = "IRR";
    public $student = "STD";
}
