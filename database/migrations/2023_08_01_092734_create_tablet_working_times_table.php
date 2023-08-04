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
        Schema::create('tablet_working_times', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("tablet_id")->nullable();
            $table->foreign('tablet_id')->references('id')
                ->on('tablets')->cascadeOnDelete();

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tablet_working_times');
    }
};
