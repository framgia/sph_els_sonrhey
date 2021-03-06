<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivitiesModel extends Model
{
    use HasFactory;

    protected $table = 'user_activities';
    protected $primaryKey = 'user_activity_id';
    protected $fillable = [
        'user_relationship_id',
        'category_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function user_relationship() {
        return $this->hasMany(UserRelationshipModel::class, 'user_relationship_id', 'user_relationship_id');
    }

    public function category() {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'category_id');
    }

    public function category_by_user() {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'category_id');
    }

    public function followed_by_user() {
        return $this->belongsTo(UserRelationshipModel::class, 'user_relationship_id', 'user_relationship_id');
    }
}
