<template>
    <InertiaHead title="Users Management" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users Management
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
                                :href="route('users.create')"
                                class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            >
                                <PlusIcon class="h-4 w-4 text-white" />

                                <span>New User</span>
                            </InertiaLink>
                        </header>

                        <table class="w-full mt-6">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <th class="text-xs text-left pr-4 py-4">Name</th>
                                    <th class="text-xs text-left px-4 py-4">Email</th>
                                    <th class="text-xs text-left px-4 py-4">Verified</th>
                                    <th class="text-xs text-left px-4 py-4">Created Date</th>
                                    <th class="text-xs text-left px-4 py-4">Last Update</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    class="border-b border-gray-100"
                                    :key="user.id"
                                    v-for="user in users.data"
                                >
                                    <td class="text-sm text-gray-700 text-left pr-4 py-4 whitespace-nowrap">
                                        {{ user.name }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        {{ user.email }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2" v-if="user.email_verified_at">
                                            <BadgeCheckIcon class="h-5 w-5 text-green-500" />
                                            <span class="font-medium text-green-500">Verified</span>
                                        </div>

                                        <div class="flex space-x-2" v-else>
                                            <XCircleIcon class="h-5 w-5 text-red-500" />
                                            <span class="font-medium text-red-500">Never</span>
                                        </div>
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        {{ format(user.created_at) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        {{ format(user.updated_at) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <InertiaLink class="text-blue-500 underline" :href="route('users.edit', user)">
                                                Edit
                                            </InertiaLink>

                                            <InertiaLink class="text-red-500 underline" :href="route('users.destroy', user)" method="delete" as="button" type="button">
                                                Delete
                                            </InertiaLink>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex items-center justify-between pt-4">
                            <Pagination :payload="users" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
    import { useSearch } from "@/Modules/use/search";
    import { userDate } from '@/Modules/use/date';
    import Pagination from "@/Components/Pagination";
    import { PlusIcon, BadgeCheckIcon,XCircleIcon } from '@heroicons/vue/solid';
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Link as InertiaLink, Head as InertiaHead} from '@inertiajs/inertia-vue3';
    import { Dropdown, Tooltip, Menu } from 'v-tooltip';
    import { VTooltip, VClosePopper } from 'v-tooltip';

    const props = defineProps({
        users: {
            required: true,
            type: Object
        }
    });

    const { search } = useSearch();
    const { format } = userDate();
</script>
