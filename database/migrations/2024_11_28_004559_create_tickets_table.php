<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 10, 2);
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('belongs_to');
            $table->enum('type', ['Motorista', 'Passageiro']);
            $table->string('car_plate')->nullable();
            $table->string('cpf', 14);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('belongs_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
