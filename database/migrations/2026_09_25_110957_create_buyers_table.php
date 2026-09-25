<?php
// database/migrations/xxxx_create_buyers_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();      // e.g. BYR-001
            $table->string('country')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->enum('buyer_type', ['Direct', 'Buying House'])->default('Direct');
            $table->string('payment_terms')->nullable(); // e.g. "LC at sight", "TT 30 days"
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void { Schema::dropIfExists('buyers'); }
};
