<x-app-layout>

    <div class="max-w-5xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-2xl font-bold">
                    Tax Return -
                    {{ \Carbon\Carbon::parse($taxReturn->tax_month)->format('F Y') }}
                </h2>

                <span class="px-3 py-1 rounded text-white
                    @if($taxReturn->status === 'paid')
                        bg-green-600
                    @elseif($taxReturn->status === 'submitted')
                        bg-blue-600
                    @else
                        bg-yellow-600
                    @endif">

                    {{ ucfirst($taxReturn->status) }}

                </span>

            </div>

            <table class="w-full border border-gray-300">

                <tbody>

                    <tr class="border-b">
                        <td class="p-3 font-semibold">
                            Revenue
                        </td>
                        <td class="p-3 text-right">
                            {{ number_format($taxReturn->total_revenue, 2) }} KHR
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="p-3 font-semibold">
                            Expense
                        </td>
                        <td class="p-3 text-right">
                            {{ number_format($taxReturn->total_expense, 2) }} KHR
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="p-3 font-semibold">
                            Payroll
                        </td>
                        <td class="p-3 text-right">
                            {{ number_format($taxReturn->total_payroll, 2) }} KHR
                        </td>
                    </tr>

                    <!-- <tr class="bg-blue-50 border-b">
                        <td class="p-3 font-bold">
                            Profit Before Tax
                        </td>
                        <td class="p-3 text-right font-bold">
                            {{ number_format($taxReturn->profit_before_tax, 2) }} KHR
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="p-3 font-semibold">
                            Profit Tax (20%)
                        </td>
                        <td class="p-3 text-right">
                            {{ number_format($taxReturn->profit_tax, 2) }} KHR
                        </td>
                    </tr>

                    <tr class="bg-green-50 border-b">
                        <td class="p-3 font-bold">
                            Profit After Tax
                        </td>
                        <td class="p-3 text-right font-bold text-green-700">
                            {{ number_format($taxReturn->profit_after_tax, 2) }} KHR
                        </td>
                    </tr> -->

                    <tr>
                        <td colspan="2"
                            class="bg-gray-100 p-3 font-bold">
                            VAT
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="p-3">
                            Output VAT
                        </td>
                        <td class="p-3 text-right">
                            {{ number_format($taxReturn->output_vat, 2) }} KHR
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="p-3">
                            Input VAT
                        </td>
                        <td class="p-3 text-right">
                            {{ number_format($taxReturn->input_vat, 2) }} KHR
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="p-3 font-semibold">
                            VAT Payable
                        </td>
                        <td class="p-3 text-right font-semibold">
                            {{ number_format($taxReturn->vat_payable, 2) }} KHR
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"
                            class="bg-gray-100 p-3 font-bold">
                            Other Taxes
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="p-3">
                            Salary Tax
                        </td>
                        <td class="p-3 text-right">
                            {{ number_format($taxReturn->salary_tax, 2) }} KHR
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="p-3">
                            Withholding Tax
                        </td>
                        <td class="p-3 text-right">
                            {{ number_format($taxReturn->withholding_tax, 2) }} KHR
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="p-3">
                            Prepayment Tax
                        </td>
                        <td class="p-3 text-right">
                            {{ number_format($taxReturn->prepayment_tax, 2) }} KHR
                        </td>
                    </tr>

                    <tr class="bg-red-50">
                        <td class="p-4 text-lg font-bold">
                            Total Tax Due
                        </td>

                        <td class="p-4 text-right text-lg font-bold text-red-700">
                            {{ number_format($taxReturn->total_tax_due, 2) }} KHR
                        </td>
                    </tr>

                </tbody>

            </table>

            <div class="mt-6 flex gap-3">

                @if($taxReturn->status === 'draft')

                <form
                    action="{{ route('business.tax-returns.submit', $taxReturn) }}"
                    method="POST">

                    @csrf

                    <button
                        class="bg-blue-600 text-white px-4 py-2 rounded">

                        Submit Return

                    </button>

                </form>

                @endif

                @if($taxReturn->status === 'submitted')

                <form
                    action="{{ route('business.tax-returns.mark-paid', $taxReturn) }}"
                    method="POST">

                    @csrf

                    <button
                        class="bg-green-600 text-white px-4 py-2 rounded">

                        Mark as Paid

                    </button>

                </form>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>