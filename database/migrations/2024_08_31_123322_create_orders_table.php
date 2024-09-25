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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //Тип содержимого "unsignedBigInteger" здесь объявлен потому что наш вторичный ключ должен быть такого же типа
            // как PrimaryKey Таблицы, с которой он связан. А там это BigInteger c аттрибутом unsigned.
            // Посмотреть тип можно в phpmyadmin в разделе structure таблицы.
//            $table->unsignedBigInteger('user_id')->nullable();

            // LaravelDocs/migrations/#foreign key constraints
            // Вот более правильное объявление отношений - делать это нужно не только в модели, но и в миграции.
            // Здесь мы указываем тип "foreign"(foreign key), указываем название столбца.
            // в свойстве references указываем название PK таблицы, с которой привязываемся, далее название таблицы.
//            $table->foreign('user_id')->references('id')->on('users');

            // Вот самый короткий и лаконичный вариант. Не нужно сначала объявлять поле FK, потом прописывать отношение.
            // Если имя таблицы и/или PK называются нестандартно или не определяются автоматически,
            // то мы можем указать их вручную - читай документацию. Последний аргумент - действие при удалении
            // материнской таблицы. Подробнее - тот же раздел документации
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title')->nullable();
            $table->mediumText('demand')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('contact')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
