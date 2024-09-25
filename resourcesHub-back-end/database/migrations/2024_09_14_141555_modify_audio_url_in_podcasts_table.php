<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAudioUrlInPodcastsTable extends Migration
{
    public function up()
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->string('audio_url')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->string('audio_url')->nullable(false)->change();
        });
    }
}
