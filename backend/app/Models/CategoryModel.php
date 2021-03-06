<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'title',
        'name'
    ];

    public function questions() {
        return $this->hasMany(QuestionModel::class, 'category_id', 'category_id');
    }
}
