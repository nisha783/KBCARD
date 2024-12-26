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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->constrained()->onDelete('cascade'); // Foreign key linking to the cards table
            $table->integer('quantity')->default(1);
            $table->integer('inner_quantity')->default(1);
            $table->decimal('total', 10, 2)->default(0); // For total calculation
            $table->decimal('inner_price_total', 10, 2)->default(0); // For inner price total
            $table->decimal('extra_inner_price', 10, 2)->default(0); // Extra inner price
            $table->decimal('discount_amount', 10, 2)->default(0); // Discount amount
            $table->decimal('grand_total', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
