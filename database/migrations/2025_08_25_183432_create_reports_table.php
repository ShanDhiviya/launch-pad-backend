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
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->date('date_of_incident');
            $table->time('time_of_incident');
            $table->enum('damage_severity', ['high', 'medium', 'low']);
            $table->decimal('estimated_cost', 10, 2);
            $table->json('photos')->nullable();
            $table->enum('status', ['draft', 'submitted', 'reviewed','approved','rejected']);
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
