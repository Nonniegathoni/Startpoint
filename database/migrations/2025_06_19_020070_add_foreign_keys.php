<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Add foreign key for users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });

        // Add foreign keys for opportunities table
        Schema::table('opportunities', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('opportunity_type_id')->references('id')->on('opportunity_types')->onDelete('cascade');
            $table->foreign('compensation_type_id')->references('id')->on('compensation_types')->onDelete('cascade');
        });

        // Add foreign keys for applications table
        Schema::table('applications', function (Blueprint $table) {
            $table->foreign('applicant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });

        // Add foreign keys for documents table
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
        });

        // Add foreign keys for interns table
        Schema::table('interns', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('set null');
        });

        // Add foreign keys for assignments table
        Schema::table('assignments', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });

        // Add foreign keys for assignment_interns table
        Schema::table('assignment_interns', function (Blueprint $table) {
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
            $table->foreign('intern_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Add foreign keys for progress_reports table
        Schema::table('progress_reports', function (Blueprint $table) {
            $table->foreign('intern_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });

        // Add foreign keys for notifications table
        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Add foreign keys for evaluations table
        Schema::table('evaluations', function (Blueprint $table) {
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
            $table->foreign('evaluator_id')->references('id')->on('users')->onDelete('cascade');
        });


    }

    public function down(): void
    {


        // Drop foreign keys for evaluations table
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign(['assignment_id']);
            $table->dropForeign(['evaluator_id']);
        });

        // Drop foreign keys for notifications table
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Drop foreign keys for progress_reports table
        Schema::table('progress_reports', function (Blueprint $table) {
            $table->dropForeign(['intern_id']);
            $table->dropForeign(['reviewed_by']);
        });

        // Drop foreign keys for assignment_interns table
        Schema::table('assignment_interns', function (Blueprint $table) {
            $table->dropForeign(['assignment_id']);
            $table->dropForeign(['intern_id']);
        });

        // Drop foreign keys for assignments table
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });

        // Drop foreign keys for interns table
        Schema::table('interns', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['supervisor_id']);
        });

        // Drop foreign keys for documents table
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['application_id']);
        });

        // Drop foreign keys for applications table
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['applicant_id']);
            $table->dropForeign(['opportunity_id']);
            $table->dropForeign(['reviewed_by']);
        });

        // Drop foreign keys for opportunities table
        Schema::table('opportunities', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['opportunity_type_id']);
            $table->dropForeign(['compensation_type_id']);
        });

        // Drop foreign key for users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });
    }
}; 