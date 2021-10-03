<template>
    <InertiaHead title="Hostel Management" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Hostels Management
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
                                :href="route('hostels.create')"
                                class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            >
                                <PlusIcon class="h-4 w-4 text-white" />

                                <span>New Hostel</span>
                            </InertiaLink>
                        </header>

                        <table class="w-full mt-6">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <th class="text-xs text-left pr-4 py-4">Name</th>
                                    <th class="text-xs text-left px-4 py-4">Type</th>
                                    <th class="text-xs text-left px-4 py-4">Has floor</th>
                                    <th class="text-xs text-left px-4 py-4">Floor count</th>
                                    <th class="text-xs text-left px-4 py-4">Created date</th>
                                    <th class="text-xs text-left px-4 py-4">Last update</th>
                                    <th class="text-xs text-left px-4 py-4">&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    class="border-b border-gray-100"
                                    :key="hostel.id"
                                    v-for="hostel in hostels.data"
                                >
                                    <td class="text-sm text-gray-700 text-left pr-4 py-4">
                                        {{ hostel.name }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        <span class="capitalize">{{ hostel.type }}</span>
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        {{ hostel.has_floors ? 'Yes' : 'No' }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        {{ hostel.floor_count }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        {{ format(hostel.updated_at) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4">
                                        <div class="flex items-center space-x-3">
                                            <InertiaLink class="text-blue-500 underline" :href="route('hostels.edit', hostel)">
                                                Edit
                                            </InertiaLink>

                                            <InertiaLink class="text-red-500 underline" :href="route('hostels.destroy', hostel)" method="delete" as="button" type="button">
                                                Delete
                                            </InertiaLink>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex items-center justify-between pt-4">
                            <Pagination :payload="hostels" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
    import { userDate } from "@/Modules/use/date";
    import { useSearch } from "@/Modules/use/search";
    import Pagination from "@/Components/Pagination";
    import { PlusIcon } from '@heroicons/vue/solid';
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Link as InertiaLink, Head as InertiaHead} from '@inertiajs/inertia-vue3';

    const props = defineProps({
        hostels: {
            required: true,
            type: Object
        }
    });

    const { search } = useSearch();
    const { format } = userDate();
</script>
