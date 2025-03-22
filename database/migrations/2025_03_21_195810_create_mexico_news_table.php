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
        Schema::create('mexico_news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->string('pdf_url')->nullable();
            $table->dateTime('published_at');
            $table->foreignId('mexico_dependency_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mexico_news');
    }
};
