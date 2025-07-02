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
        Schema::create('books_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');

            $table->tinyInteger('rating')->nullable(); // 1–5
            $table->text('review')->nullable();
            $table->date('read_at')->nullable(); // fecha en que lo leyó
            $table->boolean('is_readed')->default(false); // si lo ha leido
            $table->boolean('is_favorite')->default(false); // si es favorito
            $table->boolean('is_wishlist')->default(false); // si lo tiene en la lista de deseos

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_users');
    }
};