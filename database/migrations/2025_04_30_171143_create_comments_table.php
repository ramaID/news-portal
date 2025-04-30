<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    // database/migrations/xxxx_xx_xx_create_comments_table.php
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignUlid('post_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
