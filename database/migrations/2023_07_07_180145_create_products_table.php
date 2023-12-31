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
            $table->unsignedBigInteger('user_id');
            $table->string('categoria');
            $table->string('nome');
            $table->string('modelo');
            $table->string('marca');
            $table->decimal('preco_original', 12, 2)->nullable()->default(null);
            $table->decimal('preco_atual', 12, 2);
            $table->boolean('destaque')->default(false)->comment('1 = destaque, 0 = sem_destaque');
            $table->boolean('status')->default(false)->comment('1 = invisivel, 0 = visivel');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
