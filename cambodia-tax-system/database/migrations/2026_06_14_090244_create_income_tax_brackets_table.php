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
        Schema::create('income_tax_brackets', function (Blueprint $table) {

            $table->id();

            $table->enum(
                'taxpayer_type',
                [
                    'sole_proprietor',
                    'legal_entity',
                    'natural_resource',
                    'qip'
                ]
            );

            $table->decimal(
                'min_profit',
                15,
                2
            );

            $table->decimal(
                'max_profit',
                15,
                2
            )->nullable();

            $table->decimal(
                'tax_rate',
                5,
                2
            );

            $table->decimal(
                'deduction_amount',
                15,
                2
            )->default(0);

            $table->date(
                'effective_date'
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_tax_brackets');
    }
};
