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
        Schema::create('ljkhs', function (Blueprint $table) {
            $table->id();
            $table->date('Date')->nullable();
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('job_lists')->onDelete('cascade');
            $table->string('project')->nullable();
            $table->string('name')->nullable();
            $table->integer('id_mch')->nullable();
            $table->string('sub')->nullable();
            $table->string('id_job')->nullable();
            $table->string('work_ctr')->nullable();
            $table->string('die_part')->nullable();
            $table->string('activity_name')->nullable();
            $table->string('note', 1000)->nullable();
            $table->date('date_stop')->nullable();
            $table->Time('start')->nullable();
            $table->Time('stop')->nullable();
            $table->string('prod_hour')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ljkhs');
    }
};
