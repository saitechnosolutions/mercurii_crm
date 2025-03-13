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
        Schema::table('orf', function (Blueprint $table) {
            $table->string('dispatchdate')->nullable()->after('cs_status');
            // Replace 'new_column' with your actual column name.
            // Replace 'existing_column' with the column after which you want to add the new one.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orf', function (Blueprint $table) {
            $table->dropColumn('dispatchdate');
        });
    }
};
