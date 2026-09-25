<?php
// database/migrations/xxxx_create_employees_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();   // e.g. EMP-00001
            $table->foreignId('factory_id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->constrained()->restrictOnDelete();
            $table->foreignId('designation_id')->constrained()->restrictOnDelete();
            $table->foreignId('floor_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('production_line_id')->nullable()->constrained('production_lines')->nullOnDelete();

            $table->string('name');
            $table->string('name_bangla')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('nid_no')->nullable()->unique();
            $table->string('birth_certificate_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->default('Male');
            $table->string('blood_group', 5)->nullable();
            $table->string('religion')->nullable();
            $table->enum('marital_status', ['Single', 'Married', 'Widowed', 'Divorced'])->nullable();

            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();

            $table->date('joining_date');
            $table->enum('employee_type', ['Worker', 'Staff', 'Casual'])->default('Worker');
            $table->enum('salary_type', ['Monthly', 'Daily', 'Piece Rate'])->default('Monthly');
            $table->decimal('basic_salary', 12, 2)->default(0);
            $table->decimal('house_rent', 12, 2)->default(0);
            $table->decimal('medical_allowance', 12, 2)->default(0);
            $table->decimal('conveyance_allowance', 12, 2)->default(0);
            $table->decimal('food_allowance', 12, 2)->default(0);
            $table->decimal('gross_salary', 12, 2)->default(0);

            $table->string('bank_name')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('mobile_banking_type')->nullable(); // bKash/Nagad/Rocket
            $table->string('mobile_banking_no')->nullable();

            $table->enum('status', ['Active', 'Resigned', 'Terminated', 'Layoff'])->default('Active');
            $table->date('resign_date')->nullable();
            $table->text('resign_reason')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void { Schema::dropIfExists('employees'); }
};
