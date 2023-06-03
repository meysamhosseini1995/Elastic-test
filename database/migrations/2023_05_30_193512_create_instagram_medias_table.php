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
        Schema::create('instagram_medias', function (Blueprint $table) {
            $table->id();
            $table->foreignId("instagram_id")->constrained()->onDelete('cascade');
            $table->tinyInteger("type");
            $table->string("media_link", 2048);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instagram_medias');
    }
};
