<?php

namespace App\Services;

class StampTaxService
{
    public function calculate(
        float $propertyValueKHR
    ): array {

        $stampTax =
            $propertyValueKHR * 0.04;

        return [

            'property_value' =>
            $propertyValueKHR,

            'tax_rate' =>
            4,

            'stamp_tax' =>
            $stampTax,
        ];
    }
}
