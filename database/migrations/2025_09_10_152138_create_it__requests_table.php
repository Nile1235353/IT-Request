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
        Schema::create('it__requests', function (Blueprint $table) {
            $table->id();
            $table->string('Requester_Name');
            $table->string('Employee_ID');
            $table->string('Requester_Phone');
            $table->string('Department');
            // $table->string('Priority');
            $table->string('location')->nullable(); // New field for location
            $table->string('Issue_Category');
            $table->string('Request_Description');
            $table->string('IT_Officer');
            $table->string('Remark')->default('Null'); // New field for remark
            $table->string('status')->default('Open');
            $table->timestamps();

            // Fixed info
            // $table->string('is_fixed')->default('No'); // Yes/No
            // $table->text('Fixed_Details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('it__requests');
    }
};
