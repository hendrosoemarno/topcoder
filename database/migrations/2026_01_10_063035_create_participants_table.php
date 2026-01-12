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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('whatsapp')->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();

            // Status: SMA, Mahasiswa, Pekerja, Umum
            $table->string('status')->default('Umum');

            // SMA fields
            $table->string('school')->nullable();
            $table->string('school_class')->nullable();
            $table->string('major')->nullable();

            // Mahasiswa fields
            $table->string('campus')->nullable();
            $table->string('study_program')->nullable();
            $table->string('semester')->nullable();

            // Pekerja fields
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();

            $table->text('programming_experience')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
