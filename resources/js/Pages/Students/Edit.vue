<template>
    <InertiaHead title="Update Student" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update Student Details
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form
                    @submit.prevent="submit"
                    class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg"
                >
                    <header>
                        <h1 class="text-lg font-medium leading-6 text-gray-900">
                            Update Student Details
                        </h1>

                        <p class="text-xs text-gray-500 mt-2">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur ex excepturi labore
                            laudantium, perspiciatis sunt voluptatum. A accusantium earum error nam quibusdam soluta.
                            Aliquam harum minus neque provident qui, repellendus!
                        </p>
                    </header>

                    <div class="mt-6">
                        <BreezeValidationErrors class="mb-4" />
                    </div>

                    <div class="mt-6">
                        <div class="grid grid-cols-4 gap-3">
                            <div class="col-span-4">
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" />
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-4 gap-3">
                            <div class="col-span-4">
                                <BreezeLabel for="registration_number" value="Registration number" />
                                <BreezeInput id="registration_number" type="text" class="mt-1 block w-full" v-model="form.registration_number" />
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-4 gap-3">
                            <div class="col-span-2">
                                <BreezeLabel for="phone_number" value="Phone number" />
                                <BreezeInput id="phone_number" type="tel" class="mt-1 block w-full" v-model="form.phone_number" />
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-4 gap-3">
                            <div class="col-span-2">
                                <BreezeLabel for="gender" value="Sex" />
                                <select
                                    name="gender"
                                    id="gender"
                                    class="mt-2 block w-full rounded-md border-gray-300"
                                    v-model="form.gender"
                                >
                                    <option value="" :disabled="true">Choose...</option>
                                    <option value="female">Female</option>
                                    <option value="male">Male</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-4 gap-3">
                            <div class="col-span-4">
                                <BreezeLabel for="course_id" value="Course" />
                                <select
                                    name="course_id"
                                    id="course_id"
                                    class="mt-2 block w-full rounded-md border-gray-300"
                                    v-model="form.course_id"
                                >
                                    <option value="" :disabled="true">Choose...</option>
                                    <option :value="course.id" :key="course.id" v-for="course in courses">
                                        {{ course.name }}
                                    </option>
                                </select>
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
    import { Inertia } from '@inertiajs/inertia';
    import { Head as InertiaHead } from '@inertiajs/inertia-vue3';
    import BreezeButton from "@/Components/Button";
    import BreezeInput from "@/Components/Input";
    import BreezeLabel from "@/Components/Label";
    import BreezeValidationErrors from "@/Components/ValidationErrors";
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

    const props = defineProps({
        courses: {
            required: true,
            type: Array,
        },
        student: {
            required: true,
            type: Object,
        }
    });

    const form = reactive({
        name: props.student.name,
        registration_number: props.student.registration_number,
        phone_number: props.student.phone_number,
        gender: props.student.gender,
        course_id: props.student.course_id,
    });

    const submit = () => {
        Inertia.put(`/students/${props.student.id}`, form);
    };
</script>
