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
        Schema::create('github_users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('html_url');
            $table->string('location')->nullable();
            $table->string('bio')->nullable();
            $table->integer('public_repos');
            $table->integer('public_gists');
            $table->integer('followers');
            $table->integer('following');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('github_users');
    }
};
