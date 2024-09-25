<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'user_id',
        'reaction_type',
    ];

    /**
     * Get the post that owns the reaction.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user that owns the reaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
