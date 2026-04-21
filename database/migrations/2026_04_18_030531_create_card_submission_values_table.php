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
        Schema::create('card_submission_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('card_submissions')->cascadeOnDelete();
            $table->foreignId('field_id')->constrained('card_fields')->cascadeOnDelete();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_submission_values');
    }
};
