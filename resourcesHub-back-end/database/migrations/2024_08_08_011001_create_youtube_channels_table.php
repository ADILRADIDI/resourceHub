<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYoutubeChannelsTable extends Migration
{
    public function up()
    {
        Schema::create('youtube_channels', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name');
            $table->string('channel_url');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('youtube_channels');
    }
}
