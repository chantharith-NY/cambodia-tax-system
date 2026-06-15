<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_tax_brackets', function (Blueprint $table) {

            $table->id();

            $table->enum(
                'resident_type',
                [
                    'resident',
                    'non_resident'
                ]
            );

            $table->decimal(
                'min_salary',
                15,
                2
            );

            $table->decimal(
                'max_salary',
                15,
                2
            )->nullable();

            $table->decimal(
                'tax_rate',
                5,
                2
            );

            $table->date(
                'effective_date'
            );

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'salary_tax_brackets'
        );
    }
};
