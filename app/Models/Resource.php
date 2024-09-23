<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'url', 'category_id'];

    /**
     * Get the category that owns the resource.
     */
    // relatioship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
