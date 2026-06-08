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
        Schema::table('withholding_taxes', function (Blueprint $table) {
            $table->string('currency')
                ->default('KHR');

            $table->decimal(
                'exchange_rate',
                15,
                2
            )->default(4100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('withholding_taxes', function (Blueprint $table) {
            //
        });
    }
};
