<?php

namespace App\Services;

class VatService
{
    public function calculate(
        float $salesKHR,
        float $purchasesKHR
    ): array {

        $outputVat = $salesKHR * 0.10;

        $inputVat = $purchasesKHR * 0.10;

        $netVat = $outputVat - $inputVat;

        return [
            'sales_khr' => $salesKHR,

            'purchases_khr' => $purchasesKHR,

            'output_vat_khr' => $outputVat,

            'input_vat_khr' => $inputVat,

            'net_vat_khr' => $netVat,

            'prepayment_tax_khr' => (
                $salesKHR * 0.01
            ),
        ];
    }
}
