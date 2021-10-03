<template>
    <Head>
        <title>Create Room</title>

        <meta name="description" content="Your page description">
    </Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add New Room Type
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg">
                    <header>
                        <h1 class="text-lg font-medium leading-6 text-gray-900">
                            New Room Type
                        </h1>

                        <p class="text-xs text-gray-500 mt-2">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur ex excepturi labore
                            laudantium, perspiciatis sunt voluptatum. A accusantium earum error nam quibusdam soluta.
                            Aliquam harum minus neque provident qui, repellendus!
                        </p>
                    </header>

                    <div class="mt-6 space-y-6">
                        <div class="grid grid-cols-4 gap-3">
                            <div class="col-span-3">
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput id="name" type="text" class="mt-2 block w-full" v-model="form.name" placeholder="Double" />
                                <div v-if="errors.name" class="text-sm text-red-600 mt-2">
                                    {{ errors.name }}
                                </div>
                            </div>

                            <div class="col-span-1">
                                <BreezeLabel for="capacity" value="Capacity" />
                                <BreezeInput id="capacity" type="number" class="mt-2 block w-full" v-model="form.capacity" placeholder="2" />
                                <div v-if="errors.capacity" class="text-sm text-red-600 mt-2">
                                    {{ errors.capacity }}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-3">
                            <div class="col-span-3">
                                <BreezeLabel for="price" value="Price" />

                                <div class="relative mt-2">
                                    <div class="absolute inset-y-0 flex items-center">
                                        <select
                                            id="currency"
                                            class="border-gray-300 border-r-0 rounded-l-md"
                                            :disabled="true"
                                        >
                                            <option value="tz">Tsh.</option>
                                        </select>
                                    </div>

                                    <input type="number" id="price" class="block w-full border-gray-300 rounded-md pl-24" v-model="form.price" placeholder="0.00">
                                </div>

                                <div v-if="errors.price" class="text-sm text-red-600 mt-2">
                                    {{ errors.price }}
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
    import { reactive } from 'vue';
    import BreezeButton from '@/Components/Button';
    import BreezeInput from '@/Components/Input';
    import BreezeLabel from '@/Components/Label';
    import { Inertia } from '@inertiajs/inertia';
    import { Head } from '@inertiajs/inertia-vue3';
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

    const props = defineProps({
        errors: {
            required: true,
            type: Object,
        },
    });

    const form = reactive({
        name: '',
        capacity: '',
        price: '',
    });

    const submit = () => {
        Inertia.post(route('roomTypes.store'), form);
    };
</script>
