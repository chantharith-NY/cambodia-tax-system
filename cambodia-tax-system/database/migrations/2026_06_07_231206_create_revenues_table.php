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
        Schema::create('revenues', function (Blueprint $table) {

            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('invoice_no');

            $table->string('customer_name');

            $table->decimal('amount', 15, 2);

            $table->boolean('vat_included');

            $table->decimal('base_amount', 15, 2)
                ->nullable();

            $table->decimal('vat_amount', 15, 2)
                ->nullable();

            $table->date('invoice_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
