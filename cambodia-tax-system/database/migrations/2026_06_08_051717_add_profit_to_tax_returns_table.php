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
        Schema::table('tax_returns', function (Blueprint $table) {

            $table->decimal(
                'total_payroll',
                15,
                2
            )->default(0);

            $table->decimal(
                'profit_tax',
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
        Schema::table('tax_returns', function (Blueprint $table) {

            $table->dropColumn([
                'total_payroll',
                'profit_tax',
            ]);
        });
    }
};
