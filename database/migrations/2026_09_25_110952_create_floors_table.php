<?php
// database/migrations/xxxx_create_floors_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factory_id')->constrained()->cascadeOnDelete();
            $table->string('name');            // e.g. "3rd Floor - Sewing"
            $table->string('code')->unique();  // e.g. FL-03
            $table->unsignedInteger('total_area_sqft')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('floors'); }
};
