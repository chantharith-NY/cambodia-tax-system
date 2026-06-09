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
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('supplier_type')
                ->default('resident');

            $table->decimal(
                'withholding_rate',
                5,
                2
            )->default(0);

            $table->decimal(
                'withholding_tax',
                15,
                2
            )->default(0);

            $table->decimal(
                'net_payment',
                15,
                2
            )->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {

            $table->dropColumn([
                'supplier_type',
                'withholding_rate',
                'withholding_tax',
                'net_payment',
            ]);
        });
    }
};
