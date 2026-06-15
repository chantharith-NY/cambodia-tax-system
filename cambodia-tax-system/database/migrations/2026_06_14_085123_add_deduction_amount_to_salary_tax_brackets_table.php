<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'salary_tax_brackets',
            function (Blueprint $table) {

                $table->decimal(
                    'deduction_amount',
                    15,
                    2
                )
                    ->default(0)
                    ->after('tax_rate');
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'salary_tax_brackets',
            function (Blueprint $table) {

                $table->dropColumn(
                    'deduction_amount'
                );
            }
        );
    }
};
