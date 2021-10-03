<template>
    <Head>
        <title>Rooms Management</title>

        <meta name="description" content="Your page description">
    </Head>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Room Types Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <header class="flex items-center justify-between">
                            <input
                                type="search"
                                placeholder="search..."
                                v-model="search"
                                class="border-gray-300 rounded-md"
                            />

                            <Link
                                :href="route('roomTypes.create')"
                                class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            >
                                <PlusIcon class="h-4 w-4 text-white" />

                                <span>New Room Type</span>
                            </Link>
                        </header>

                        <table class="w-full mt-6">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <th class="text-xs text-left pr-4 py-4">Number</th>
                                    <th class="text-xs text-right px-4 py-4">Capacity</th>
                                    <th class="text-xs text-right px-4 py-4">Price</th>
                                    <th class="text-xs text-left px-4 py-4">Created date</th>
                                    <th class="text-xs text-left px-4 py-4">Last update</th>
                                    <th class="text-xs text-left px-4 py-4">&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    class="border-b border-gray-100"
                                    :key="roomType.id"
                                    v-for="roomType in roomTypes.data"
                                >
                                    <td class="text-sm text-gray-700 text-left pr-4 py-4">
                                        {{ roomType.name }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-right px-4 py-4">
                                        {{ roomType.capacity }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-right px-4 py-4">
                                        {{ toCurrency(roomType.price) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        {{ format(roomType.created_at) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        {{ format(roomType.updated_at) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        <div class="flex items-center space-x-3">
                                            <Link class="text-blue-500 underline" :href="route('roomTypes.edit', roomType)">
                                                Edit
                                            </Link>

                                            <Link class="text-red-500 underline" :href="route('roomTypes.destroy', roomType)" method="delete" as="button" type="button">
                                                Delete
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex items-center justify-between pt-4">
                            <Pagination :payload="roomTypes" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
    import { useSearch } from "@/Modules/use/search";
    import { userDate } from "@/Modules/use/date";
    import { useNumber } from "@/Modules/use/format";
    import Pagination from "@/Components/Pagination";
    import { PlusIcon } from '@heroicons/vue/solid';
    import { Link, Head } from '@inertiajs/inertia-vue3';
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

    const props = defineProps({
        roomTypes: {
            required: true,
            type: Object
        }
    });

    const { search } = useSearch();
    const { format } = userDate();
    const { toCurrency } = useNumber();
</script>
