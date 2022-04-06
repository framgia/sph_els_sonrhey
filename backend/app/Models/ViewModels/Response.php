<?php

namespace App\Models\ViewModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_code',
        'message',
        'data',
    ];
}
