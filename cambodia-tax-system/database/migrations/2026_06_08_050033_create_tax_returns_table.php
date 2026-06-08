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
        Schema::create('tax_returns', function (Blueprint $table) {

            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('tax_month');

            $table->decimal(
                'total_revenue',
                15,
                2
            )->default(0);

            $table->decimal(
                'total_expense',
                15,
                2
            )->default(0);

            $table->decimal(
                'output_vat',
                15,
                2
            )->default(0);

            $table->decimal(
                'input_vat',
                15,
                2
            )->default(0);

            $table->decimal(
                'vat_payable',
                15,
                2
            )->default(0);

            $table->decimal(
                'salary_tax',
                15,
                2
            )->default(0);

            $table->decimal(
                'withholding_tax',
                15,
                2
            )->default(0);

            $table->decimal(
                'prepayment_tax',
                15,
                2
            )->default(0);

            $table->decimal(
                'total_tax_due',
                15,
                2
            )->default(0);

            $table->enum(
                'status',
                [
                    'draft',
                    'submitted',
                    'paid'
                ]
            )->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_returns');
    }
};
