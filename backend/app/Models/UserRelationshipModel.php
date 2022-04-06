<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRelationshipModel extends Model
{
    use HasFactory;

    protected $table = 'user_relationships';
    protected $primaryKey = 'user_relationship_id';
    protected $fillable = [
        'following_id',
        'followed_id'
    ];
}
