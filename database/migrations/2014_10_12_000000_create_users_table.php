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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('nome_loja', 100);
            $table->string('cnpj_cpf')->unique();
            $table->string('telefone', 20);
            $table->string('email', 100);

            $table->string('logradouro', 200);
            $table->string('numero', 12);
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->string('uf', 2);
            $table->string('tipo_usuario', 20)->default('user');
            $table->boolean('permissao')->default(false);
            $table->boolean('fiado')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
