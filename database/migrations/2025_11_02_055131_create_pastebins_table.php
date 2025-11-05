<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pastebins', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url_pastebin');
            $table->boolean('is_protected')->default(false);
            $table->string('password')->nullable();
            $table->string('extension')->default('md');
            $table->string('token_del');
            $table->dateTime('expire_at')->nullable();
            $table->unsignedInteger('view')->default(0);
            $table->unsignedInteger('download')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastebins');
    }
};
