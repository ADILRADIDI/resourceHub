<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    // Specify the fillable attributes
    protected $fillable = [
        'title',
        'description',
        'url',
        'image_url',
    ];

    // Optionally, you can define relationships if needed
    // For example, if an ad belongs to a user:
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
