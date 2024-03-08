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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->nullable()->unique();
            // $table->foreignId('store_id')->nullable()->constrained('stores')->nullOnDelete();
            $table->rememberToken();
            $table->timestamps();
        });
        // Schema::table('users', function($table) {
        //     $table->foreign('store_id')->references('id')->on('stores')->nullOnDelete();
        //     // $table->foreignId('store_id')->nullable()->constrained('stores')->nullOnDelete();

        //   });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
