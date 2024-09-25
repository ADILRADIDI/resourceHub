<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            // google id for auth with google
            $table->string('google_id')->unique()->nullable();
            $table->string('password');
            $table->text('bio')->nullable();
            $table->string('profile_picture')->nullable();
            // website location position
            $table->string('website')->nullable();
            $table->string('location')->nullable();
            $table->string('position')->nullable();
            // add brand color and set default #ffffff
            $table->string('brand_color')->default('#ffffff');
            // add premium status true or false default false
            $table->boolean('is_premium')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->date('birthday')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
