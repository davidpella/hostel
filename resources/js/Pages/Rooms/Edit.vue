<template>
    <InertiaHead title="Create Room" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update Room Details
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg">
                    <header>
                        <h1 class="text-lg font-medium leading-6 text-gray-900">
                            Update Room Details
                        </h1>

                        <p class="text-xs text-gray-500 mt-2">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur ex excepturi labore
                            laudantium, perspiciatis sunt voluptatum. A accusantium earum error nam quibusdam soluta.
                            Aliquam harum minus neque provident qui, repellendus!
                        </p>
                    </header>

                    <div class="mt-6 space-y-6">
                        <div class="grid grid-cols-4 gap-3">
                            <div class="col-span-2">
                                <BreezeLabel for="number" value="Number #" />
                                <BreezeInput id="number" type="text" class="mt-2 block w-full" v-model="form.number" placeholder="G001" />
                                <div v-if="errors.number" class="text-sm text-red-600 mt-2">
                                    {{ errors.number }}
                                </div>
                            </div>

                            <div class="col-span-2">
                                <BreezeLabel for="room_type_id" value="Type" />
                                <select
                                    id="room_type_id"
                                    class="mt-2 block w-full rounded-md border-gray-300"
                                    v-model="form.room_type_id"
                                >
                                    <option value="" :disabled="true">Choose...</option>
                                    <option :value="roomType.id" :key="roomType.id" v-for="roomType in roomTypes">
                                        {{ roomType.name }}
                                    </option>
                                </select>
                                <div v-if="errors.room_type_id" class="text-sm text-red-600 mt-2">
                                    {{ errors.room_type_id }}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-3">
                            <div class="col-span-4">
                                <BreezeLabel for="location" value="Location" />
                                <BreezeInput id="location" type="text" class="mt-2 block w-full" v-model="form.location" placeholder="1st floor" />
                                <div v-if="errors.location" class="text-sm text-red-600 mt-2">
                                    {{ errors.location }}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-3">
                            <div class="col-span-4">
                                <BreezeLabel for="hostel" value="Hostel" />
                                <select
                                    id="hostel_id"
                                    class="mt-2 block w-full rounded-md border-gray-300"
                                    v-model="form.hostel_id"
                                >
                                    <option value="" :disabled="true">Choose...</option>
                                    <template :key="hostel.id" v-for="hostel in hostels">
                                        <option :value="hostel.id">
                                            {{ hostel.name }}
                                        </option>
                                        <option value="" :disabled="true">
                                            &rarr; Location type: {{ hostel.type }}; Floors: {{ hostel.floor_count }}
                                        </option>
                                    </template>
                                </select>
                                <div v-if="errors.hostel_id" class="text-sm text-red-600 mt-2">
                                    {{ errors.hostel_id }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-6" />

                    <footer class="flex justify-end mt-4">
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save changes
                        </BreezeButton>
                    </footer>
                </form>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import {reactive, ref, watch} from 'vue';
    import { Inertia } from '@inertiajs/inertia';
    import BreezeButton from "@/Components/Button";
    import BreezeInput from "@/Components/Input";
    import BreezeLabel from "@/Components/Label";
    import { Head as InertiaHead } from '@inertiajs/inertia-vue3';
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

    const props = defineProps({
        room: {
            required: true,
            type: Object,
        },
        errors: {
            required: true,
            type: Object,
        },
        hostels: {
            required: true,
            type: Array,
        },
        roomTypes: {
            required: true,
            type: Array,
        },
    });

    let capacity = ref('');
    let price = ref('')

    const form = reactive({
        number: props.room.number,
        location: props.room.location,
        hostel_id: props.room.hostel_id,
        room_type_id: props.room.room_type_id,
    });

    watch(() => form.room_type_id, (id) => {
        let roomType = props.roomTypes.find(roomType => {
            return roomType.id = id;
        });

        price.value = roomType.price;

        capacity.value = roomType.capacity;
    });

    const submit = () => {
        Inertia.put(route('rooms.update', props.room), form);
    };
</script>
