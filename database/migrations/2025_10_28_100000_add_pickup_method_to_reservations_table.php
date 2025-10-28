<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->enum('pickup_method', ['self_pickup', 'delivery'])->default('self_pickup')->after('pickup_time');
            $table->string('delivery_address')->nullable()->after('pickup_method');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['pickup_method', 'delivery_address']);
        });
    }
};
