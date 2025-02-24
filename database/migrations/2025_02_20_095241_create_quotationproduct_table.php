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
        Schema::create('quotationproduct', function (Blueprint $table) {
            $table->id();
            $table->string('quotationno'); // Format: Quota-123
            $table->string('cliname');
            $table->string('placeofsupply');
            $table->string('gstnum')->nullable();
            $table->string('catepro');
            $table->string('product');
            $table->string('part_no')->nullable();
            $table->integer('quanty');
            $table->decimal('allowdis', 10, 2)->nullable();
            $table->decimal('requestdis', 10, 2)->nullable();
            $table->decimal('ratee', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('priceamt', 10, 2);
            $table->decimal('lbt', 10, 2)->nullable();
            $table->decimal('tax', 10, 2);
            $table->decimal('taxamt', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotationproduct');
    }
};
