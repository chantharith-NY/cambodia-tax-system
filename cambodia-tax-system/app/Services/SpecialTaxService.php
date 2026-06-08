<?php

namespace App\Services;

class SpecialTaxService
{
    public function calculate(
        float $alcoholTobaccoKHR,
        float $roomStaysKHR,
        float $luxuryGoodsKHR,
        float $specificTaxRate
    ): array {

        $publicLightingTax =
            $alcoholTobaccoKHR * 0.05;

        $accommodationTax =
            $roomStaysKHR * 0.02;

        $specificTax =
            $luxuryGoodsKHR *
            $specificTaxRate;

        return [

            'public_lighting_tax_khr'
            => $publicLightingTax,

            'accommodation_tax_khr'
            => $accommodationTax,

            'specific_tax_khr'
            => $specificTax,

            'total_tax_khr' =>
            $publicLightingTax +
                $accommodationTax +
                $specificTax,
        ];
    }
}
