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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('location');
            $table->string('avatar')->nullable(); // Profile picture URL
            $table->longText('bio'); // About me description
            $table->string('title')->nullable(); // Professional title
            $table->string('availability_status')->default('open'); // open, busy, closed
            $table->string('website')->nullable();
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('resume_url')->nullable(); // CV/Resume file URL
            $table->json('languages')->nullable(); // Array of languages
            $table->integer('years_experience')->default(0); // e.g., 7
            $table->integer('completed_projects')->default(0); // e.g., 120
            $table->integer('happy_clients')->default(0); // e.g., 50
            $table->longText('about_me')->nullable(); // Detailed about me section
            $table->string('headline')->nullable(); // e.g., "Welcome to my world"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
