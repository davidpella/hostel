<template>
    <InertiaHead title="Update Academic Year" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update Academic Year Details
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
                            Update Academic Year
                        </h1>

                        <p class="text-xs text-gray-500 mt-2">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur ex excepturi labore
                            laudantium, perspiciatis sunt voluptatum. A accusantium earum error nam quibusdam soluta.
                            Aliquam harum minus neque provident qui, repellendus!
                        </p>
                    </header>

                    <BreezeValidationErrors class="mb-4" />

                    <div class="grid grid-cols-4 gap-3 mt-6">
                        <div class="col-span-4">
                            <BreezeLabel for="name" value="Name" />
                            <BreezeInput id="name" type="text" class="mt-2 block w-full" v-model="form.name" />
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
    import { Head as InertiaHead } from '@inertiajs/inertia-vue3';
    import BreezeButton from "@/Components/Button";
    import BreezeInput from "@/Components/Input";
    import BreezeLabel from "@/Components/Label";
    import BreezeValidationErrors from "@/Components/ValidationErrors";
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { reactive} from "vue";
    import { Inertia } from "@inertiajs/inertia";

    const props = defineProps({
        academicYear: {
            required: true,
            type: Object,
        }
    });

    const form = reactive({
        name: props.academicYear.name,
    });

    const submit = () => {
        Inertia.put(route('academicYears.update', props.academicYear), form);
    };
</script>
