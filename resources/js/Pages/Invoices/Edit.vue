<template>
    <InertiaHead title="Update Invoice" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update Invoice Details
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
                            Update Invoice Details
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
                                <BreezeLabel for="amount" value="Amount" />
                                <BreezeInput id="amount" type="number" class="mt-2 block w-full" v-model="form.amount" />
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-3 mt-6">
                            <div class="col-span-4">
                                <BreezeLabel for="room_id" value="Room" />
                                <select
                                    name="room_id"
                                    id="room_id"
                                    class="mt-2 block w-full rounded-md border-gray-300"
                                    v-model="form.room_id"
                                >
                                    <option value="" :disabled="true">Choose...</option>
                                    <template :key="room.id" v-for="room in rooms">
                                        <option :value="room.id">
                                            {{ room.number }}
                                        </option>
                                        <option value="" :disabled="true">
                                            &rarr; Hostel: {{ room.hostel.name }};
                                        </option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-3 mt-6">
                            <div class="col-span-4">
                                <BreezeLabel for="student_id" value="Student" />
                                <select
                                    name="student_id"
                                    id="student_id"
                                    class="mt-2 block w-full rounded-md border-gray-300"
                                    v-model="form.student_id"
                                >
                                    <option value="" :disabled="true">Choose...</option>
                                    <template :key="student.id" v-for="student in students">
                                        <option :value="student.id">
                                            {{ student.name }}
                                        </option>
                                        <option value="" :disabled="true">
                                            &rarr; Course: {{ student.course.name }};
                                        </option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-3 mt-6">
                            <div class="col-span-2">
                                <BreezeLabel for="academic_year" value="Academic year" />
                                <select
                                    name="academic_year"
                                    id="academic_year"
                                    class="mt-2 block w-full rounded-md border-gray-300"
                                    v-model="form.academic_year"
                                >
                                    <option value="" :disabled="true">Choose...</option>
                                    <option value="1" :key="year" v-for="year in 5">
                                        Year {{ year }}
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
        invoice: {
            required: true,
            type: Object,
        },
        rooms: {
            required: true,
            type: Array,
        },
        students: {
            required: true,
            type: Array,
        }
    });

    const form = reactive({
        amount: props.invoice.amount,
        student_id: props.invoice.student_id,
        room_id: props.invoice.room_id,
        academic_year: props.invoice.academic_year,
    });

    const submit = () => {
        Inertia.put(`/invoices/${props.invoice.id}`, form);
    };
</script>
