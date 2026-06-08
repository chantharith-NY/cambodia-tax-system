<?php

namespace App\Services;

class WithholdingTaxService
{
    private array $rates = [
        'rental' => 0.10,
        'services' => 0.15,
        'royalties_interest' => 0.15,
        'non_resident' => 0.14,
    ];

    public function calculate(
        float $grossAmountKHR,
        string $paymentType
    ): array {

        $rate = $this->rates[$paymentType];

        $tax = $grossAmountKHR * $rate;

        return [
            'gross_amount_khr' => $grossAmountKHR,

            'withholding_tax_khr' => $tax,

            'net_amount_khr' => (
                $grossAmountKHR - $tax
            ),

            'rate' => $rate,
        ];
    }

    public function calculateGrossFromNet(
        float $netAmountKHR,
        string $paymentType
    ): array {

        $rate = $this->rates[$paymentType];

        $grossAmount = $netAmountKHR == 0
            ? 0
            : $netAmountKHR / (1 - $rate);

        return $this->calculate(
            $grossAmount,
            $paymentType
        );
    }
}
