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
            $table->unsignedBigInteger('category_id');
            $table->string('nome');
            $table->string('marca');
            $table->string('modelo');
            $table->longText('descricao');
            $table->integer('preco_atual');
            $table->boolean('destaque')->default(false)->comment('1 = destaque, 0 = sem_destaque');
            $table->boolean('status')->default(false)->comment('1 = invisivel, 0 = visivel');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
