<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('cohorts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('code_name', 150)->nullable();
            $table->string('president', 150)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('created_by', 200)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('cohorts');
    }
};