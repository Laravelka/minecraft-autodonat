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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->decimal('price', 10); // Цена (десятичное число)
            $table->enum('duration', ['month', 'three_months', 'forever'])->nullable(); // Время действия цены
            $table->boolean('extra_payment')->default(false); // Доплата при наличии другой привилегии
            $table->unsignedBigInteger('category_id'); // Ссылка на таблицу categories
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('luckperms_group'); // Название группы в LuckPerms
            $table->string('command_month')->nullable(); // Команда выдачи для месяца
            $table->string('command_three_months')->nullable(); // Команда выдачи для трёх месяцев
            $table->string('command_forever')->nullable(); // Команда выдачи навсегда
            $table->boolean('allow_promocodes')->default(true); // Разрешение использовать промокоды
            $table->unsignedBigInteger('server_id'); // Ссылка на таблицу servers
            $table->foreign('server_id')->references('id')->on('servers');
            $table->text('description')->nullable(); // Описание товара

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
