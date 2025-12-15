<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('destination_name', 150);
            $table->string('country', 100);
            $table->string('city', 100)->nullable();
            $table->text('description')->nullable();
            $table->date('travel_date')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('tag', 50)->nullable();
            $table->string('image')->nullable(); // Store image path instead of blob
            $table->string('image_type', 100)->nullable();
            $table->enum('status', ['Noted', 'Completed'])->default('Noted');
            $table->timestamps(); // This creates created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
