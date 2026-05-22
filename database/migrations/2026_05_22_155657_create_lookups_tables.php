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
        Schema::create('campuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('competency_schemes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campus_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
            
            // Indeks gabungan agar pencarian skema berdasarkan nama dan kampus cepat
            $table->index(['campus_id', 'name']);
        });

        Schema::create('iscos', function (Blueprint $table) {
            $table->id();
            $table->integer('level'); // 1, 2, 3, atau 4
            $table->string('code')->unique(); // e.g., '2', '22', '221', '2211'
            $table->string('title_en')->nullable();
            $table->string('title_id')->nullable();
            $table->timestamps();
            
            $table->index('code');
        });

        Schema::create('isics', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title_en')->nullable();
            $table->string('title_id')->nullable();
            $table->timestamps();
            
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isics');
        Schema::dropIfExists('iscos');
        Schema::dropIfExists('competency_schemes');
        Schema::dropIfExists('campuses');
    }
};
