<template>
    <InertiaHead title="Rooms Management" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Rooms Management
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

                            <InertiaLink
                                :href="route('rooms.create')"
                                class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            >
                                <PlusIcon class="h-4 w-4 text-white" />

                                <span>New Room</span>
                            </InertiaLink>
                        </header>

                        <table class="w-full mt-6">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <th class="text-xs text-left pr-4 py-4">Number</th>
                                    <th class="text-xs text-right px-4 py-4">Capacity</th>
                                    <th class="text-xs text-right px-4 py-4">Price</th>
                                    <th class="text-xs text-left px-4 py-4">Location</th>
                                    <th class="text-xs text-left px-4 py-4">Hostel</th>
                                    <th class="text-xs text-left px-4 py-4">Created date</th>
                                    <th class="text-xs text-left px-4 py-4">Last update</th>
                                    <th class="text-xs text-left px-4 py-4">&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    class="border-b border-gray-100"
                                    :key="room.id"
                                    v-for="room in rooms.data"
                                >
                                    <td class="text-sm text-gray-700 text-left pr-4 py-4">
                                        {{ room.number }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-right px-4 py-4">
                                        {{ room.type.name }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-right px-4 py-4">
                                        {{ toCurrency(room.type.price) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        {{ room.location }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        {{ room.hostel.name }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        {{ format(room.created_at) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        {{ format(room.updated_at) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        <div class="flex items-center space-x-3">
                                            <InertiaLink class="text-blue-500 underline" :href="route('rooms.edit', room)">
                                                Edit
                                            </InertiaLink>

                                            <InertiaLink class="text-red-500 underline" :href="route('rooms.destroy', room)" method="delete" as="button" type="button">
                                                Delete
                                            </InertiaLink>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex items-center justify-between pt-4">
                            <Pagination :payload="rooms" />
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
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Link as InertiaLink, Head as InertiaHead } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        rooms: {
            required: true,
            type: Object
        }
    });

    const { search } = useSearch();
    const { format } = userDate();
    const { toCurrency } = useNumber();
</script>
