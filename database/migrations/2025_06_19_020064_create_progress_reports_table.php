<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progress_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intern_id');
            $table->enum('report_type', ['weekly', 'monthly']);
            $table->date('report_period_start');
            $table->date('report_period_end');
            $table->text('tasks_completed');
            $table->text('challenges_faced')->nullable();
            $table->text('lessons_learned')->nullable();
            $table->text('next_week_goals')->nullable();
            $table->text('supervisor_feedback')->nullable();
            $table->integer('rating')->nullable(); // 1-5 scale
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('created_by', 200)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_reports');
    }
}; 