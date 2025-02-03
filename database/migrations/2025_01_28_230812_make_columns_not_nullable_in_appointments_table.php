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
        Schema::table('appointments', function (Blueprint $table) {
            // Make columns not nullable
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('date')->nullable(false)->change();
            $table->string('doctor')->nullable(false)->change();
            $table->string('user_id')->nullable(false)->change();
            $table->string('message')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Revert columns back to nullable
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('date')->nullable()->change();
            $table->string('doctor')->nullable()->change();
            $table->string('user_id')->nullable()->change();
            $table->string('message')->nullable()->change();
        });
    }
};
