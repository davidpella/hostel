<template>
    <InertiaHead title="Manage Invoices" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invoices
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between py-4">
                    <div class="space-x-4">
                        <select
                            class="text-sm border-transparent rounded-md bg-gray-200"
                            id="academic_year"
                            v-model="filters.academic_year"
                        >
                            <option value="" :disabled="true">Academic year</option>
                            <option
                                :value="year.id"
                                :key="year.id"
                                v-for="year in academicYears"
                            >
                                {{ year.name }}
                            </option>
                        </select>

                        <select
                            class="text-sm border-transparent rounded-md bg-gray-200"
                            id="hostel"
                            v-model="filters.hostel"
                        >
                            <option value="" :disabled="true">Hostel</option>
                            <option
                                :value="hostel.id"
                                :key="hostel.id"
                                v-for="hostel in hostels"
                            >
                                {{ hostel.name }}
                            </option>
                        </select>

                        <select
                            class="text-sm border-transparent rounded-md bg-gray-200"
                            id="course"
                            v-model="filters.course"
                        >
                            <option value="" :disabled="true">Course</option>
                            <option
                                :value="course.id"
                                :key="course.id"
                                v-for="course in courses"
                            >
                                {{ course.name }}
                            </option>
                        </select>
                    </div>

                    <a
                        :href="route('invoices.export', filters)"
                        class="inline-flex items-center space-x-2 hover:bg-gray-200 px-4 py-3 rounded-md text-sm text-gray-700 font-medium"
                    >
                        <DownloadIcon class="h-5 w-5 text-gray-500" />

                        <span>Export as excel</span>
                    </a>
                </div>

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
                                :href="route('invoices.create')"
                                class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            >
                                <PlusIcon class="h-4 w-4 text-white" />

                                <span>New Invoice</span>
                            </InertiaLink>
                        </header>

                        <table class="w-full mt-6">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <th class="text-xs text-left pr-4 py-4 whitespace-nowrap text-left">Student</th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap text-left">Sex</th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap text-left">Course</th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap text-left">Registration number</th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap text-left">Room</th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap text-left">Room type</th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap text-right">Amount</th>
                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap text-left">Academic year</th>
<!--                                    <th class="text-xs text-left px-4 py-4 whitespace-nowrap text-right">&nbsp;</th>-->
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    class="border-b border-gray-100"
                                    :key="invoice.id"
                                    v-for="invoice in invoices.data"
                                >
                                    <td class="text-sm text-gray-700 whitespace-nowrap align-top text-left pr-4 py-4 text-left">
                                        {{ invoice.application.student.name }}
                                    </td>
                                    <td class="text-sm text-gray-700 whitespace-nowrap align-top text-left px-4 py-4 text-left">
                                        <span class="capitalize">{{ invoice.application.student.gender }}</span>
                                    </td>
                                    <td class="text-sm text-gray-700 whitespace-nowrap align-top text-left px-4 py-4 text-left">
                                        {{ invoice.application.student.course.name }}
                                    </td>
                                    <td class="text-sm text-gray-700 whitespace-nowrap align-top text-left px-4 py-4 text-left">
                                        <div class="flex flex-col space-y-1">
                                            <span class="font-medium">
                                                {{ invoice.application.student.registration_number }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ invoice.application.student.continuation }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-sm text-gray-700 whitespace-nowrap align-top text-left px-4 py-4 text-left">
                                        <template v-if="invoice.room">
                                            {{ invoice.room.name }}
                                        </template>
                                        <template v-else>
                                            <Dropdown placement="right" :offset="[0, 16]">
                                                <button class="text-blue-700">Assign room</button>

                                                <template #popper>
                                                    <div class="w-56">
                                                        <header class="border-b border-gray-200 pb-4">
                                                            <h3 class="text-sm font-medium text-gray-500">
                                                                Room assignment
                                                            </h3>
                                                        </header>

                                                        <div class="w-full mt-5">
                                                            <label class="block w-full text-sm font-medium" for="room_id">Room</label>
                                                            <select id="room_id" class="mt-2 block w-full text-sm rounded-md border-gray-300">
                                                                <option value="" :disabled="true">Choose</option>
                                                                <option value="1">G001</option>
                                                                <option value="1">G002</option>
                                                            </select>
                                                        </div>

                                                        <footer class="w-full mt-6 flex justify-end">
                                                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                                                Save changes
                                                            </button>
                                                        </footer>
                                                    </div>
                                                </template>
                                            </Dropdown>
                                        </template>
                                    </td>
                                    <td class="text-sm text-gray-700 whitespace-nowrap align-top text-left px-4 py-4 text-left">
                                        <div class="flex flex-col space-y-1">
                                            <span class="font-medium">
                                                {{ invoice.application.room_type.name }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ invoice.application.room_type.capacity }} people capacity
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-sm text-gray-700 whitespace-nowrap align-top text-right px-4 py-4 text-right">
                                        {{ toCurrency(invoice.amount) }}
                                    </td>
                                    <td class="text-sm text-gray-700 whitespace-nowrap align-top text-left px-4 py-4 text-left">
                                        {{ invoice.application.academic_year.name }}
                                    </td>
<!--                                    <td class="text-sm text-gray-700 whitespace-nowrap align-top text-left px-4 py-4 text-left">-->
<!--                                        <div class="flex items-center space-x-3">-->
<!--                                            <InertiaLink class="text-blue-500 underline" :href="route('invoices.edit', invoice)">-->
<!--                                                Edit-->
<!--                                            </InertiaLink>-->

<!--                                            <InertiaLink class="text-red-500 underline" :href="route('invoices.destroy', invoice)" method="delete" as="button" type="button">-->
<!--                                                Delete-->
<!--                                            </InertiaLink>-->
<!--                                        </div>-->
<!--                                    </td>-->
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex items-center justify-between pt-4">
                            <Pagination :payload="invoices" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
    import { reactive, watch } from 'vue';
    import { useSearch } from '@/Modules/use/search';
    import { useNumber } from '@/Modules/use/format';
    import Pagination from '@/Components/Pagination';
    import { PlusIcon, DownloadIcon } from '@heroicons/vue/solid';
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Link as InertiaLink, Head as InertiaHead} from '@inertiajs/inertia-vue3';
    import {Inertia} from '@inertiajs/inertia';
    import { Dropdown } from 'v-tooltip';

    const props = defineProps({
        invoices: {
            required: true,
            type: Object
        },
        courses: {
            required: true,
            type: Array
        },
        hostels: {
            required: true,
            type: Array
        },
        academicYears: {
            required: true,
            type: Array
        },
    });

    const filters = reactive({
        semester: '',
        hostel: '',
        course: '',
        academic_year: '',
    });

    watch(() => filters.semester, (semester) => {
        Inertia.reload({ data: { semester }});
    });

    watch(() => filters.hostel, (hostel) => {
        Inertia.reload({ data: { hostel }});
    });

    watch(() => filters.course, (course) => {
        Inertia.reload({ data: { course }});
    });

    watch(() => filters.academic_year, (academic_year) => {
        Inertia.reload({ data: { academic_year }});
    });

    const { search } = useSearch();
    const { toCurrency } = useNumber();
</script>
