<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('type', ['sedan','suv','luxury','ev','van','pickup'])->index();
            $table->enum('transmission', ['automatic','manual'])->default('automatic');
            $table->unsignedTinyInteger('seats')->default(5);
            $table->decimal('price_per_day', 10, 2)->index();
            $table->string('location')->index();
            $table->boolean('is_available')->default(true)->index();
            $table->string('image_url')->nullable();
            $table->json('features')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
