<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE `cars` MODIFY `type` ENUM('sedan','suv','luxury','ev','van','pickup','mpv') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `cars` MODIFY `type` ENUM('sedan','suv','luxury','ev','van','pickup') NOT NULL");
    }
};
