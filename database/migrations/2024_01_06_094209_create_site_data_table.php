<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_data', function (Blueprint $table) {
            $table->id();
            $table->text('landing_page_text');
        });

        DB::table('site_data')->insert([
            'landing_page_text' => 'Click Characters to get started. The tracker will display all your tasks and characters. To create new tasks, go
            to “Task Manager” Chat with others using Discuss in the forum!',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_data');
    }
};
