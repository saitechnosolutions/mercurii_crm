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
        Schema::table('leaddesigns', function (Blueprint $table) {
            $table->decimal('basicsupply', 15, 2)->nullable()->after('pricevalue');
            $table->decimal('freightvalue', 15, 2)->nullable()->after('basicsupply');
            $table->decimal('installvalue', 15, 2)->nullable()->after('freightvalue');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leaddesigns', function (Blueprint $table) {
            $table->dropColumn(['basicsupply', 'freightvalue', 'installvalue']);
        });
    }
};
