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
        Schema::create('twitters', function (Blueprint $table) {
            $table->id();
            $table->foreignId("producer_id")->constrained()->onDelete('cascade');
            $table->integer("retweet")->unsigned()->default(0);
            $table->string("content",280);
            $table->string("image_link", 2048);
            $table->string("source_link", 2048);
            $table->dateTime("publication_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twitters');
    }
};
