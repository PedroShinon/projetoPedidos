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
            $table->integer('user_id');
            $table->integer('loja_id');
            $table->string('tracking_code');
            $table->string('nome_completo');
            $table->string('endereco');
            $table->string('email');
            $table->string('numero_tel');
            $table->string('pincode');
            $table->string('status_pedidos');
            $table->integer('quantidade');
            $table->decimal('preco_total', 12, 2);
            $table->timestamps();
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
