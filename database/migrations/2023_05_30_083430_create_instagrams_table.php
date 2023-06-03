<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //max character text twitter : 280
    //max character text twitter : 2200

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instagrams', function (Blueprint $table) {
            $table->id();
            $table->foreignId("producer_id")->constrained()->onDelete('cascade');
            $table->string("title",255);
            $table->string("content",2200);
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
        Schema::dropIfExists('instagrams');
    }
};
