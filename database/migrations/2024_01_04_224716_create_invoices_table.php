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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('number', $precision = 9);
            $table->double('value', 12, 2);
            $table->dateTime('date_of_issue');
            $table->string('sender_cnpj');
            $table->string('sender_name');
            $table->string('transporter_cnpj');
            $table->string('transporter_name');

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
