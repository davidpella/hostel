<template>
    <div class="flex">
        <div class="w-1/2 bg-gray-200"></div>

        <div class="w-1/2">
            <div class="my-12 mx-auto max-w-lg">
                <div v-if="$page.props.flash.success" class="bg-green-50 text-sm text-green-900 font-medium py-4 px-4 rounded-md border border-green-300">
                    {{ $page.props.flash.success }}
                </div>

                <form @submit.prevent="submit" class="space-y-6 mt-6">
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
                                name="gender"
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
                                name="course_id"
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
                                name="continuation"
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
                                    :placeholder="registration_number_placeholder"
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
                                        Special needs student
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        These are students who have been identified to have serious medical condition
                                        and so need special attention, and those with physical disabilities/health
                                        challenges, which may qualify them for accommodation, will be given individual
                                        consideration before others, only after receiving their medical report from the
                                        Office of the Dean of Students. Students with very special needs should consult
                                        the Dean of Students for further advice
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <hr />

                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-2 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="academic_year_id">
                                Academic year
                            </label>

                            <select
                                id="academic_year_id"
                                v-model="form.academic_year_id"
                                class="block w-full text-sm border-gray-300 rounded-md"
                            >
                                <option value="" :disabled="true">Choose...</option>
                                <option :value="academicYear.id" :key="academicYear.id" v-for="academicYear in academicYears">
                                    {{ academicYear.name }}
                                </option>
                            </select>

                            <div v-if="errors.academic_year_id" class="text-sm text-red-600">
                                {{ errors.academic_year_id }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-2 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="room_type_id">
                                Room Type
                            </label>

                            <select
                                id="room_type_id"
                                v-model="form.room_type_id"
                                class="block w-full text-sm border-gray-300 rounded-md"
                            >
                                <option value="" :disabled="true">Choose...</option>
                                <option :value="roomType.id" :key="roomType.id" v-for="roomType in roomTypes">
                                    {{ roomType.name }}
                                </option>

                            </select>

                            <div v-if="errors.room_type_id" class="text-sm text-red-600">
                                {{ errors.room_type_id }}
                            </div>
                        </div>

                        <div class="col-span-2 space-y-2">
                            <label class="block w-full text-sm text-gray-700 font-medium" for="amount">
                                Amount
                            </label>

                            <input
                                type="number"
                                id="amount"
                                name="amount"
                                placeholder="0.00"
                                v-model="form.amount"
                                class="block w-full text-sm border-gray-300 rounded-md"
                                :disabled="true"
                            />

                            <div v-if="errors.amount" class="text-sm text-red-600">
                                {{ errors.amount }}
                            </div>
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
    </div>
</template>

<script>
    import { Inertia } from '@inertiajs/inertia';

    export default {
        props: {
            errors: {
                required: true,
                type: Object,
            },
            courses: {
                required: true,
                type: Array,
            },
            roomTypes: {
                required: true,
                type: Array,
            },
            academicYears: {
                required: true,
                type: Array,
            },
        },

        data() {
            return {
                form: {
                    name: '',
                    gender: '',
                    continuation: '',
                    locale: false,
                    course_id: '',
                    room_type_id: '',
                    academic_year_id: '',
                    is_disabled: false,
                    amount: '',
                    registration_number: '',
                    registration_number_type: 'csee',
                },
                registration_number_placeholder: 'P0209/0001'
            }
        },

        watch: {
            'form.room_type_id': function(id) {
                let room = this.roomTypes.find((roomType) => {
                    return roomType.id === id;
                });

                this.form.amount = room.price;
            },
            'form.continuation': function (value) {
                if (value === 'continuing') {
                    this.form.registration_number_type = 'college';

                    this.registration_number_placeholder = 'MK/MD/20/0000';
                }

                if (value === 'fresh') {
                    this.form.registration_number_type = 'csee';

                    this.registration_number_placeholder = 'S0332/0300/2016';
                }
            }
        },

        methods: {
            submit() {
                Inertia.post(this.route('applications.store'), this.form);
            },
        }
  }
</script>
