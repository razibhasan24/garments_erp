<?php
// database/migrations/xxxx_create_machines_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('floor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('production_line_id')->nullable()->constrained('production_lines')->nullOnDelete();
            $table->string('name');            // e.g. "Plain Machine"
            $table->string('asset_code')->unique(); // e.g. MC-000123
            $table->string('brand')->nullable();     // Juki, Brother
            $table->string('model_no')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->enum('status', ['Running', 'Idle', 'Under Maintenance', 'Scrapped'])->default('Running');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('machines'); }
};
