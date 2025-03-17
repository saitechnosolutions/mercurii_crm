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
        Schema::table('product_categories_tb', function (Blueprint $table) {
            $table->enum('type', ['mhe', 'rack','pallet'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_categories_tb', function (Blueprint $table) {
            $table->string('type')->change(); // Revert back to string if needed
        });
    }
};
