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
        Schema::create('purchase_history', function (Blueprint $table) {
            $table->id();
            $table->string('player_nickname');
            $table->timestamp('invoice_paid_at');
            $table->string('player_email');
            $table->decimal('invoice_price', 10);
            $table->string('issue_command');
            $table->text('server_response')->nullable();

            $table->unsignedBigInteger('user_id')->nullable(); // Ссылка на таблицу users
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('product_id'); // Ссылка на таблицу products
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('promocode_id')->nullable(); // Ссылка на таблицу promocodes
            $table->foreign('promocode_id')->references('id')->on('promocodes');
            $table->unsignedBigInteger('server_id'); // Ссылка на таблицу servers
            $table->foreign('server_id')->references('id')->on('servers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocodes');
    }
};
