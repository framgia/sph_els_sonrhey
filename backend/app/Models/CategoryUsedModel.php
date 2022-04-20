<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryUsedModel extends Model
{
    use HasFactory;

    protected $table = 'categories_used';
    protected $primaryKey = 'categories_used_id';
    protected $fillable = [
        'category_id',
        'status_id',
        'question_id',
        'user_id'
    ];

    public function status() {
        return $this->belongsTo(StatusModel::class, 'status_id', 'status_id');
    }
}
