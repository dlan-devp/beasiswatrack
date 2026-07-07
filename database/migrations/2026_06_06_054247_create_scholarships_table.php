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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('institution');
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->dateTime('open_date');
            $table->dateTime('close_date');
            $table->string('application_link');
            $table->string('type')->default('Penuh'); // Penuh, Sebagian, Partial
            $table->string('category')->default('S1'); // S1, S2, S3, D3, D4, SMA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
