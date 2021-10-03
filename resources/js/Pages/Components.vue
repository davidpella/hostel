<template>
    <div class="max-w-md mx-auto my-20 divide-y">
        <div class="py-8">
            <h2 class="mb-4 text-sm font-medium text-gray-600">Select Box</h2>

            <Listbox v-model="selectedPerson">
                <div class="relative inline-block">
                    <ListboxButton class="px-2 py-1.5 rounded bg-gray-50">
                        {{ selectedPerson.name }}
                    </ListboxButton>

                    <ListboxOptions class="border">
                        <ListboxOption
                            v-for="person in people"
                            :key="person"
                            :value="person"
                            :disabled="person.unavailable"
                            class="px-2 py-1"
                        >
                            {{ person.name }}
                        </ListboxOption>
                    </ListboxOptions>
                </div>
            </Listbox>
        </div>


        <div class="py-8">
            <h2 class="mb-4 text-sm font-medium text-gray-600">
                Phone number: {{ parsedPhoneNumber }}
            </h2>

            <div>
                <div class="relative">
                    <select
                        class="border-transparent absolute text-sm bg-transparent"
                        v-model="callingCode"
                    >
                        <option value="KE">+254</option>
                        <option value="TZ">+255</option>
                        <option value="UG">+256</option>
                    </select>

                    <input
                        type="tel"
                        class="text-sm pl-24 border-gray-300 rounded-md"
                        placeholder="714 681 951"
                        v-model="phoneNumber"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref, watch} from 'vue';
    import parsePhoneNumber from 'libphonenumber-js'
    import { AsYouType } from 'libphonenumber-js';
    import { Listbox, ListboxButton, ListboxOptions, ListboxOption } from '@headlessui/vue'

    const people = [
        { id: 1, name: 'Durward Reynolds', unavailable: false },
        { id: 2, name: 'Kenton Towne', unavailable: false },
        { id: 3, name: 'Therese Wunsch', unavailable: false },
        { id: 4, name: 'Benedict Kessler', unavailable: true },
        { id: 5, name: 'Katelyn Rohan', unavailable: false },
    ];

    const selectedPerson = ref(people[0]);

    const phoneNumber = ref('');
    const callingCode = ref('TZ');

    const parsedPhoneNumber = computed(() =>
        new AsYouType(callingCode.value).input(phoneNumber.value)
    );

    watch(phoneNumber, (number) => {
        let parsed = new AsYouType(callingCode).input(number);

        console.log(parsed);
    })
</script>
