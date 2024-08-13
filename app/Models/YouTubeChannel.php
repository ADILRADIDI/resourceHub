<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouTubeChannel extends Model
{
    use HasFactory;
    // name of my table in my databse
    protected $table = 'youtube_channels';

    protected $fillable = [
        'channel_name',
        'channel_url',
    ];
}

