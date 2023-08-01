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
        Schema::create('ad_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("advertiser_id")->nullable();
            $table->foreign('advertiser_id')->references('id')
                ->on('advertisers')->cascadeOnDelete();
            $table->unsignedBigInteger("campaign_id")->nullable();
            $table->foreign('campaign_id')->references('id')
                ->on('campaigns')->cascadeOnDelete();

            $table->float('duration')->nullable();
            $table->integer('order')->nullable();
            $table->string('url')->nullable();
            $table->string('name')->nullable();
            $table->boolean('is_placeholder')->nullable()->default(true);
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_videos');
    }
};
