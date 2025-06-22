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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->json('address'); // JSON like {"country":"Bangladesh","city":"Dhaka","post_code":"1216"}
            $table->timestamps();
        });
    }

    // TODO: Add indexes for better performance in the country and post_code fields.

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
