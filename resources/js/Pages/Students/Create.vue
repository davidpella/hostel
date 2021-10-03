<template>
    <InertiaHead title="Add New Student" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add New Student
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="space-y-6 w-full max-w-lg p-6 my-8 overflow-hidden align-middle bg-white shadow-xl rounded-lg">
                    <header>
                        <h1 class="text-lg font-medium leading-6 text-gray-900">
                            New Student
                        </h1>

                        <p class="text-xs text-gray-500 mt-2">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur ex excepturi labore
                            laudantium, perspiciatis sunt voluptatum. A accusantium earum error nam quibusdam soluta.
                            Aliquam harum minus neque provident qui, repellendus!
                        </p>
                    </header>

                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-4 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="name">
                                Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="James D. Peter"
                                v-model="form.name"
                                class="block w-full text-sm border-gray-300 rounded-md"
                            />

                            <div v-if="errors.name" class="text-sm text-red-600">
                                {{ errors.name }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-2 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="phone">
                                Phone number
                            </label>

                            <div class="relative">
                                <button class="pl-3 absolute inset-y-0 flex items-center text-sm">
                                    +255
                                </button>

                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    placeholder="714 689 151"
                                    v-model="form.phone"
                                    class="pl-14 block w-full text-sm border-gray-300 rounded-md"
                                />
                            </div>

                            <div v-if="errors.phone" class="text-sm text-red-600">
                                {{ errors.phone }}
                            </div>
                        </div>

                        <div class="col-span-2 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="email">
                                Email address <span class="text-gray-400">optional</span>
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="james.peter@example.com"
                                v-model="form.email"
                                class="block w-full text-sm border-gray-300 rounded-md"
                            />

                            <div v-if="errors.email" class="text-sm text-red-600">
                                {{ errors.email }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-2 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="gender">
                                Gender
                            </label>

                            <select
                                id="gender"
                                v-model="form.gender"
                                class="block w-full text-sm border-gray-300 rounded-md"
                            >
                                <option value="" :disabled="true">Choose...</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>

                            <div v-if="errors.gender" class="text-sm text-red-600">
                                {{ errors.gender }}
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-2 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="course_id">
                                Course
                            </label>

                            <select
                                id="course_id"
                                v-model="form.course_id"
                                class="block w-full text-sm border-gray-300 rounded-md"
                            >
                                <option value="" :disabled="true">Choose...</option>
                                <option :value="course.id" :key="course.id" v-for="course in courses">
                                    {{ course.name }}
                                </option>
                            </select>

                            <div v-if="errors.course_id" class="text-sm text-red-600">
                                {{ errors.course_id }}
                            </div>
                        </div>

                        <div class="col-span-2 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="continuation">
                                Continuation
                            </label>

                            <select
                                id="continuation"
                                v-model="form.continuation"
                                class="block w-full text-sm border-gray-300 rounded-md"
                            >
                                <option value="" :disabled="true">Choose...</option>
                                <option value="continuing">Continuing</option>
                                <option value="fresh">Fresh</option>
                            </select>

                            <div v-if="errors.continuation" class="text-sm text-red-600">
                                {{ errors.continuation }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-2 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="registration_number">
                                Registration number
                            </label>

                            <div class="relative rounded-md">
                                <select
                                    class="pl-3 absolute inset-y-0 flex items-center text-sm rounded-md bg-transparent border-transparent"
                                    v-model="form.registration_number_type"
                                >
                                    <option value="csee">CSEE</option>
                                    <option value="college">College</option>
                                    <option value="other">Other</option>
                                </select>

                                <input
                                    type="text"
                                    id="registration_number"
                                    name="registration_number"
                                    :placeholder="registrationNumberPlaceholder"
                                    v-model="form.registration_number"
                                    class="pl-28 block w-full text-sm border-gray-300 rounded-md"
                                />
                            </div>

                            <div v-if="errors.registration_number" class="text-sm text-red-600">
                                {{ errors.registration_number }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-4 space-y-6 bg-gray-100 px-6 py-6 rounded-lg">
                            <label class="block w-full flex space-x-4" for="locale">
                                <input type="checkbox" id="locale" name="locale" class="mt-1 h-5 w-5 border-gray-300 rounded" />

                                <span class="block w-full flex flex-col space-y-1">
                                    <span class="text-sm text-gray-700 font-medium">
                                        International
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        Student who chose to undertake all or part of their tertiary education in a country
                                        other than their own and move to that country for the purpose of studying.
                                    </span>
                                </span>
                            </label>
                            <hr>
                            <label class="block w-full flex space-x-4" for="is_disabled">
                                <input type="checkbox" id="is_disabled" name="is_disabled" class="mt-1 h-5 w-5 border-gray-300 rounded" />

                                <span class="block w-full flex flex-col space-y-1">
                                    <span class="text-sm text-gray-700 font-medium">
                                        Disability
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        Student with any condition of the body or mind (impairment) that makes it
                                        more difficult for the person with the condition to do certain activities
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <hr />

                    <footer class="flex items-center justify-end">
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Save changes
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import {reactive, ref, watch} from 'vue';
    import { Inertia } from '@inertiajs/inertia';
    import { Head as InertiaHead } from '@inertiajs/inertia-vue3';
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

    const props = defineProps({
        errors: {
            required: true,
            type: Object,
        },
        courses: {
            required: true,
            type: Array,
        }
    });

    const registrationNumberPlaceholder = ref('P0209/0001');

    const form = reactive({
        name: '',
        gender: '',
        phone_number: '',
        email: '',
        course_id: '',
        type: '',
        registration_number: '',
        continuation: '',
        locale: false,
        is_disabled: false,
        registration_number_type: 'csee',
    });

    watch(() => form.continuation, (value) => {
        if (value === 'continuing') {
            form.registration_number_type = 'college';

            registrationNumberPlaceholder.value = 'MK/MD/20/0000';
        }

        if (value === 'fresh') {
            form.registration_number_type = 'csee';

            registrationNumberPlaceholder.value = 'P0209/0001';
        }
    });

    const submit = () => {
        Inertia.post(route('students.store'), form);
    };
</script>
