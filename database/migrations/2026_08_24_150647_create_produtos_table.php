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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id(); // id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            $table->string('nome', 255); //  nome VARCHAR(255),
            $table->decimal('preco', 10, 2); // preco DECIMAL(10, 8)
            $table->integer('estoque'); // estoque INT
            $table->timestamps(); //     created_at TIMESTAMP,   updated_at TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
