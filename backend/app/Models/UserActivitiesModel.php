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
}
