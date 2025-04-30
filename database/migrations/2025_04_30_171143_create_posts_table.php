<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    // database/migrations/xxxx_xx_xx_create_posts_table.php
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignUlid('topic_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
