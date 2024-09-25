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
        'video',
        'document',
        'pdf',
        'status',
        'user_id'
    ];

    // Optionally, specify the attributes that should be cast to native types
    protected $casts = [
        'tags' => 'array',
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

    //
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags'); // Ensure the pivot table name is correct
    }
    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class);
    // }




    //
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
