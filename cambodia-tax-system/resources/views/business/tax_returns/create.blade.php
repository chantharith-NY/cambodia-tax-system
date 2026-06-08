<x-app-layout>

    <div class="max-w-2xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Generate Tax Return
            </h2>

            <form
                action="{{ route('business.tax-returns.store') }}"
                method="POST">

                @csrf

                <div>

                    <label>
                        Tax Month
                    </label>

                    <input
                        type="month"
                        name="tax_month"
                        class="w-full border rounded p-2"
                        required>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">

                        Generate

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>