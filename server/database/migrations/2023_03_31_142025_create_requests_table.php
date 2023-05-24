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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('document_id')->index();
            $table->bigInteger('admin_id')->index()->nullable();
            $table->bigInteger('valid_id')->index();
            $table->date('date_requested');
            $table->string('purpose');
            $table->enum('status', ['pending','proccessing','approved', 'rejected', 'completed'])->index();
            $table->decimal('fee');
            $table->longText('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
