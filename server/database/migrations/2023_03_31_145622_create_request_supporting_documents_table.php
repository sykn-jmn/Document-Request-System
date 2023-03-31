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
        Schema::create('request_supporting_documents', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->bigInteger('supporting_document_id')->index();
            $table->bigInteger('transaction_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_supporting_documents');
    }
};
