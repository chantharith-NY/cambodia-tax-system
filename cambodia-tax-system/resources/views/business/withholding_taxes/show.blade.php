<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Withholding Tax Details
            </h2>

            <div class="space-y-3">

                <p>
                    <strong>Vendor:</strong>
                    {{ $withholdingTax->vendor_name }}
                </p>

                <p>
                    <strong>Payment Type:</strong>
                    {{ ucfirst(str_replace('_', ' ', $withholdingTax->payment_type)) }}
                </p>

                <p>
                    <strong>Gross Amount:</strong>
                    {{ number_format($withholdingTax->gross_amount, 2) }} KHR
                </p>

                <p>
                    <strong>Tax Rate:</strong>
                    {{ $withholdingTax->tax_rate }} %
                </p>

                <p>
                    <strong>Withholding Tax:</strong>
                    {{ number_format($withholdingTax->withholding_tax, 2) }} KHR
                </p>

                <p>
                    <strong>Net Payment:</strong>
                    {{ number_format($withholdingTax->net_amount, 2) }} KHR
                </p>

                <p>
                    <strong>Payment Date:</strong>
                    {{ $withholdingTax->payment_date->format('d-M-Y') }}
                </p>

                <p>
                    <strong>Description:</strong>
                    {{ $withholdingTax->description }}
                </p>

            </div>

        </div>

    </div>

</x-app-layout>