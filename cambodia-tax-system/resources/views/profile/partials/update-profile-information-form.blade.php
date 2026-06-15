<div class="space-y-5">

    <div>
        <x-input-label for="name" value="Full Name" />
        <x-text-input
            id="name"
            name="name"
            type="text"
            class="mt-2 block w-full rounded-xl"
            :value="old('name', $user->name)"
            required />
    </div>

    <div>
        <x-input-label for="email" value="Email Address" />
        <x-text-input
            id="email"
            name="email"
            type="email"
            class="mt-2 block w-full rounded-xl"
            :value="old('email', $user->email)"
            required />
    </div>

    <div class="flex items-center gap-4">

        <x-primary-button>
            Save Changes
        </x-primary-button>

    </div>

</div>