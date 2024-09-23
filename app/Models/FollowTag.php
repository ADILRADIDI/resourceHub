<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowTag extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tag_id'];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the Tag model
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
