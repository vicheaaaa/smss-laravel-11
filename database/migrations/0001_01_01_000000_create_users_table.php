<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sex'); // Added directly in the creation
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('student'); // Added directly in the creation
            $table->integer('year_of_study')->nullable(); // Added directly in the creation
            $table->string('major')->nullable(); // Added directly in the creation
            $table->string('department')->nullable(); // Added directly in the creation
            $table->date('graduate_day')->nullable(); // Added directly in the creation
            $table->string('status')->default('active')->nullable(); // Added directly in the creation
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
