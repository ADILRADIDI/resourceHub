<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'posts';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'title',
        'body',
        'image',
        'user_id',
        'status',
    ];

    // Optionally, specify the attributes that should be cast to native types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Optionally, specify the attributes that should be hidden from arrays
    protected $hidden = [
        // Add any hidden attributes here
    ];

    // Define relationships if needed
    // Example: if each post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Example: if each post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
