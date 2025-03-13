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
        Schema::table('quotationproduct', function (Blueprint $table) {
            $table->string('shippostalcode')->nullable()->after('placeofsupply');
            $table->unsignedBigInteger('shcitylist')->nullable()->after('shippostalcode');
            $table->unsignedBigInteger('shistate_id')->nullable()->after('shcitylist');
            $table->unsignedBigInteger('shippingcountry')->nullable()->after('shistate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotationproduct', function (Blueprint $table) {
            $table->dropColumn(['shippostalcode', 'shcitylist', 'shistate_id', 'shippingcountry']);
        });
    }
};
