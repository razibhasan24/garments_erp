<?php
// database/migrations/xxxx_create_production_lines_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('production_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('floor_id')->constrained()->cascadeOnDelete();
            $table->string('name');           // e.g. "Line-01"
            $table->string('code')->unique(); // e.g. LN-01
            $table->unsignedInteger('machine_capacity')->default(0);
            $table->unsignedInteger('manpower_capacity')->default(0);
            $table->enum('line_type', ['Sewing', 'Cutting', 'Finishing', 'Packing'])->default('Sewing');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('production_lines'); }
};
