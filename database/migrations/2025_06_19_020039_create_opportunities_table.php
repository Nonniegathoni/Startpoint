<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('opportunity_description')->nullable();
            $table->text('core_competencies')->nullable();
            $table->string('compensation_currency', 10)->nullable();
            $table->float('compensation_amount'); // As per diagram
            $table->date('expiry_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('created_by', 200)->nullable();

            // Foreign keys will be added in a separate migration
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('opportunity_type_id');
            $table->unsignedBigInteger('compensation_type_id');

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('opportunities');
    }
};