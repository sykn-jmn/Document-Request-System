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
    $table->bigInteger('profile_picture_id')->index()->nullable();
    $table->string('email')->unique();
    $table->string('first_name');
    $table->string('middle_name');
    $table->string('last_name');
    $table->date('birthdate');
    $table->string('birthplace')->nullable();
    $table->enum('sex',['male','female']);
    $table->enum('civil_status',['single','married','widow','separate']);
    $table->string('suffix')->nullable();
    $table->string('citizenship')->nullable();
    $table->string('mobile_number');
    $table->string('religion')->nullable();
    $table->string('purok')->nullable();
    $table->string('baranggay')->nullable();
    $table->string('municipality')->nullable();
    $table->string('province')->nullable();
    $table->string('zip_code')->nullable();
    $table->string('mothers_firstname');
    $table->string('mothers_middlename');
    $table->string('mothers_lastname');
    $table->timestamp('email_verified_at')->nullable();
    $table->string('email_code')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
