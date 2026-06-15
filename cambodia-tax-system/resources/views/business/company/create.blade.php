<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Company Profile
            </h2>

            <form
                action="{{ route('business.company.store') }}"
                method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label>Company Name *</label>

                        <input
                            type="text"
                            name="company_name"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <div>
                        <label>Tax Number</label>

                        <input
                            type="text"
                            name="tax_number"
                            class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label>Industry</label>

                        <input
                            type="text"
                            name="industry"
                            class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">

                        <label class="block mb-1">
                            Business Type
                        </label>

                        <select
                            name="business_type"
                            class="w-full border rounded p-2"
                            required>

                            <option value="legal_entity">
                                នីតិបុគ្គល (Legal Entity)
                            </option>

                            <option value="sole_proprietorship">
                                សហគ្រាសឯកបុគ្គល (Sole Proprietorship)
                            </option>

                            <option value="natural_resource">
                                Natural Resource Enterprise
                            </option>

                            <option value="qip">
                                Qualified Investment Project (QIP)
                            </option>

                        </select>

                    </div>

                    <div>
                        <label>Phone</label>

                        <input
                            type="text"
                            name="phone"
                            class="w-full border rounded p-2">
                    </div>

                </div>

                <div class="mt-4">

                    <label>Address</label>

                    <textarea
                        name="address"
                        rows="3"
                        class="w-full border rounded p-2"></textarea>

                </div>

                <div class="mt-6">

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                        Save Company
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>