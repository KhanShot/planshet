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
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tablet_id")->nullable();
            $table->foreign('tablet_id')->references('id')
                ->on('tablets')->cascadeOnDelete();

            $table->unsignedBigInteger("video_id")->nullable();
            $table->foreign('video_id')->references('id')
                ->on('ad_videos')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
