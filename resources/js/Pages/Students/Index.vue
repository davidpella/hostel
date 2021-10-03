<template>
    <InertiaHead title="Students Management" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Students Management
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
                                :href="route('students.create')"
                                class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            >
                                <PlusIcon class="h-4 w-4 text-white" />

                                <span>New Student</span>
                            </InertiaLink>
                        </header>

                        <table class="w-full mt-6">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <th class="text-xs text-left pr-4 py-4 whitespace-nowrap">
                                        Name
                                    </th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap">
                                        Registration number
                                    </th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap">
                                        Phone number
                                    </th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap">
                                        Gender
                                    </th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap">
                                        Course
                                    </th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap">
                                        Created Date
                                    </th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap">
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    class="border-b border-gray-100"
                                    :key="student.id"
                                    v-for="student in students.data"
                                >
                                    <td class="text-sm text-gray-700 text-left pr-4 py-4 whitespace-nowrap">
                                        {{ student.name }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        {{ student.registration_number }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        {{ student.phone }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        <span class="capitalize">{{ student.gender }}</span>
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        {{ student.course.name }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        {{ format(student.created_at) }}
                                    </td>
                                    <td class="text-sm text-gray-700 text-left px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <InertiaLink class="text-blue-500 underline" :href="route('students.edit', student)">
                                                Edit
                                            </InertiaLink>

                                            <InertiaLink class="text-red-500 underline" :href="route('students.destroy', student)" method="delete" as="button" type="button">
                                                Delete
                                            </InertiaLink>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex items-center justify-between pt-4">
                            <Pagination :payload="students" />
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
    import Pagination from "@/Components/Pagination";
    import { PlusIcon } from '@heroicons/vue/solid';
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Link as InertiaLink, Head as InertiaHead } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        students: {
            required: true,
            type: Object
        }
    });

    const { search } = useSearch();
    const { format } = userDate();
</script>
