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
        Schema::create('campaign_form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->default(0)->index();
            $table->string('label');
            $table->string('name');
            $table->enum('type', ['text', 'textarea', 'select', 'radio', 'checkbox', 'date', 'email', 'number']);
            $table->json('options')->nullable();
            $table->boolean('required')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_form_fields');
    }
};
