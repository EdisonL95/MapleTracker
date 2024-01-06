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
        Schema::create('base_collection', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('description');
            $table->string('reward');
            $table->boolean('priority');
            $table->string('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_collection');
    }
};
