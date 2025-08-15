<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id')->foreignId('loan_id')->constrained('loans')->onDelete('cascade');
            // $table->foreignId('loan_id')->constrained('loans')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('paid_at')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
