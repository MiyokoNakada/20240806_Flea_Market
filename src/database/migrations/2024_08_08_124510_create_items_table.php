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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('brand', 255)->nullable();
            $table->integer('price');
            $table->boolean('sold')->default(false);
            $table->string('image',255)->nullable();
            $table->text('description')->nullable();
            // $table->foreignID('category_id')->constrained();
            $table->foreignID('condition_id')->constrained();
            $table->foreignID('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
