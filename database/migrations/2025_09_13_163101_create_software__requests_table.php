<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('software_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id')->unique();
            $table->string('requester_name');
            $table->string('employee_id');
            $table->string('requester_email');
            $table->string('requester_phone');
            $table->string('department');
            $table->string('location');
            $table->dateTime('request_date');
            $table->string('priority');
            $table->string('system');
            $table->string('type');
            $table->string('issue_category');
            $table->string('other_category')->nullable();
            $table->text('request_description')->nullable();
            $table->string('assignee')->nullable();
            $table->text('software_comment')->nullable();
            $table->string('testers')->nullable();
            $table->date('launched_date')->nullable();
            $table->date('job_done_date')->nullable();
            $table->text('user_feedback')->nullable();
            $table->text('remark')->nullable();
            $table->string('status')->default('Open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software__requests');
    }
};
