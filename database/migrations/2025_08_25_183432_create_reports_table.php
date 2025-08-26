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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->date('date_of_incident')->nullable();
            $table->time('time_of_incident')->nullable();
            $table->enum('damage_severity', ['high', 'medium', 'low'])->default('low');
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->string('photos')->nullable();
            $table->enum('status', ['draft', 'submitted', 'reviewed','approved','rejected'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
