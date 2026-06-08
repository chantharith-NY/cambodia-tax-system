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

    public function getRates(): array
    {
        return $this->rates;
    }

    public function calculate(
        float $grossAmountKHR,
        string $paymentType
    ): array {

        if ($grossAmountKHR < 0) {
            throw new \InvalidArgumentException(
                'Amount cannot be negative.'
            );
        }

        if (!isset(
            $this->rates[$paymentType]
        )) {
            throw new \InvalidArgumentException(
                'Invalid payment type.'
            );
        }

        $rate = $this->rates[$paymentType];

        $tax = $grossAmountKHR * $rate;

        return [
            'gross_amount_khr' => $grossAmountKHR,
            'withholding_tax_khr' => $tax,
            'net_amount_khr' => $grossAmountKHR - $tax,
            'rate' => $rate,
        ];
    }

    public function calculateGrossFromNet(
        float $netAmountKHR,
        string $paymentType
    ): array {

        if ($netAmountKHR < 0) {
            throw new \InvalidArgumentException(
                'Amount cannot be negative.'
            );
        }

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
