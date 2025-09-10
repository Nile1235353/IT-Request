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
            $table->string('Issue_Category');
            $table->string('Request_Description');
            $table->string('Remark');
            $table->timestamps();
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
