<template>
    <Head title="Register" />

    <BreezeValidationErrors class="mb-4" />

    <div class="flex bg-white rounded-lg overflow-hidden h-screen">
        <div class="w-1/2">
            <div class="sticky top-0 bottom-0">
                <img
                    src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=987&q=80"
                    alt="Cover Image"
                    class="object-cover w-full h-screen"
                />
            </div>
        </div>

        <div class="w-1/2 overflow-y-auto">
            <form @submit.prevent="submit" class="px-20 py-16">
                <header class="mb-12 flex space-x-4">
                    <Link href="/">
                        <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                    </Link>

                    <div>
                        <h1 class="text-lg text-gray-800 font-bold">
                            Registration
                        </h1>

                        <p class="mt-2 text-sm text-gray-600 font-normal">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum modi quis tenetur. Ad, debitis quo.
                        </p>
                    </div>
                </header>

                <div class="flex justify-end">
                    <div class="bg-gray-100 inline-flex items-center space-x-4 p-1 rounded-md shadow-inner">
                        <label class="items-center" for="graduate">
                            <input
                                type="radio"
                                id="graduate"
                                name="type"
                                v-model="form.type"
                                value="graduate"
                                class="hidden"
                            />

                            <span :class="['flex items-center px-2 py-1.5 space-x-2 rounded-md cursor-pointer', {'bg-white shadow-sm': form.type === 'graduate'}]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" v-if="form.type === 'graduate'">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>

                            <span class="text-sm font-medium text-gray-700">Graduate</span>
                        </span>
                        </label>

                        <label class="flex items-center space-x-2" for="staff">
                            <input
                                type="radio"
                                id="staff"
                                name="type"
                                v-model="form.type"
                                value="staff"
                                class="hidden"
                            />

                            <span :class="['flex items-center px-2 py-1.5 space-x-2 rounded-md cursor-pointer', {'bg-white shadow-sm': form.type === 'staff'}]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" v-if="form.type === 'staff'">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>

                            <span class="text-sm font-medium text-gray-700">Staff</span>
                        </span>
                        </label>
                    </div>
                </div>

                <hr class="mt-6" />

                <div class="flex -mx-3 mt-6">
                    <div class="w-2/3 px-3">
                        <label class="block text-sm text-gray-600" for="course_id">
                            Course Graduated HKMU
                        </label>

                        <select
                            name="course_id"
                            id="course_id"
                            v-model="form.course_id"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                        >
                            <option value="" disabled>Choose...</option>
                            <option :value="course.id" :key="course.id" v-for="course in graduatedCourses">
                                {{ course.name }}
                            </option>
                        </select>
                    </div>

                    <div class="w-1/3 px-3">
                        <label class="block text-sm text-gray-600" for="graduation_year">
                            Graduation Year
                        </label>

                        <select
                            name="graduation_year"
                            id="graduation_year"
                            v-model="form.graduation_year"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                        >
                            <option value="" disabled>Choose...</option>
                            <option :value="year" :key="year" v-for="year in graduationYears">
                                {{ year }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex -mx-3 mt-6">
                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="educational_level">
                            Educational Level
                        </label>

                        <select
                            name="educational_level"
                            id="educational_level"
                            v-model="form.educational_level"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                        >
                            <option value="" disabled>Choose...</option>
                            <option value="certificate">Certificate</option>
                            <option value="diploma">Diploma</option>
                            <option value="bachelor degree">Bachelor Degree</option>
                            <option value="Master">Master</option>
                            <option value="phd">Doctor of Philosophy (PhD.)</option>
                        </select>
                    </div>
                </div>

                <hr class="mt-8" />

                <div class="flex -mx-3 mt-6">
                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="first_name">
                            First Name
                        </label>

                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                            v-model="form.first_name"
                            required
                            placeholder="James"
                        />
                    </div>

                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="last_name">
                            Last Name
                        </label>

                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                            v-model="form.last_name"
                            required
                            placeholder="Peter"
                        />
                    </div>
                </div>

                <div class="flex -mx-3 mt-6">
                    <div class="w-full px-3">
                        <label class="block text-sm text-gray-600" for="middle_name">
                            Middle Name <span class="text-gray-400">(Optional)</span>
                        </label>

                        <input
                            type="text"
                            id="middle_name"
                            name="middle_name"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                            v-model="form.middle_name"
                            autocomplete="middle_name"
                        />
                    </div>
                </div>


                <div class="flex -mx-3 mt-6">
                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="gender">
                            Gender
                        </label>

                        <select
                            name="gender"
                            id="gender"
                            v-model="form.gender"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                        >
                            <option value="" disabled>Choose...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>

                <template v-if="form.type === 'staff'">
                    <hr class="mt-8" />

                    <div class="flex -mx-3 mt-6">
                        <div class="w-full px-3">
                            <label class="block text-sm text-gray-600" for="current_employee">
                                Institution/Employee
                            </label>

                            <input
                                type="text"
                                id="current_employee"
                                name="current_employee"
                                class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                                v-model="form.current_employee"
                                required
                                placeholder="Hubert Kairuki Memorial University (HKMU)"
                            />
                        </div>
                    </div>

                    <div class="flex -mx-3 mt-6">
                        <div class="w-1/2 px-3">
                            <label class="block text-sm text-gray-600" for="position">
                                Position
                            </label>

                            <input
                                type="text"
                                id="position"
                                name="position"
                                class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                                v-model="form.position"
                                required
                                placeholder="Doctor of Medicine (MD)"
                            />
                        </div>
                    </div>
                </template>

                <hr class="mt-8" />

                <div class="flex -mx-3 mt-6">
                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                            v-model="form.email"
                            required
                            placeholder="james.peter@example.com"
                        />
                    </div>

                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="phone_number">
                            Phone number
                        </label>

                        <input
                            type="tel"
                            id="phone_number"
                            name="phone_number"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                            v-model="form.phone_number"
                            required
                            placeholder="+255 712 345 678"
                        />
                    </div>
                </div>

                <div class="flex -mx-3 mt-6">
                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="country">
                            Country
                        </label>

                        <select
                            id="country"
                            name="country"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                            v-model="form.country"
                            required
                        >
                            <option value="">Select...</option>
                            <option :value="country" v-for="country in countries">
                                {{ country }}
                            </option>
                        </select>
                    </div>

                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="city">
                            City
                        </label>

                        <input
                            type="text"
                            id="city"
                            name="city"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                            v-model="form.city"
                            required
                            placeholder="Dar es Salaam"
                        />
                    </div>
                </div>

                <div class="flex -mx-3 mt-6">
                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="password">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                            v-model="form.password"
                            required
                            autocomplete="password"
                        />
                    </div>

                    <div class="w-1/2 px-3">
                        <label class="block text-sm text-gray-600" for="password_confirmation">
                            Password Confirmation
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="block mt-2 w-full border-gray-300 rounded-md text-sm"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="password_confirmation"
                        />
                    </div>
                </div>

                <hr class="mt-6" />

                <footer class="flex items-center justify-end mt-4">
                    <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Already registered?
                    </Link>

                    <button
                        type="submit"
                        class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >Register</button>
                </footer>
            </form>
        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import BreezeApplicationLogo from "@/Components/ApplicationLogo";

export default {
    components: {
        Head,
        Link,
        BreezeValidationErrors,
        BreezeApplicationLogo,
    },

    props: {
        graduationYears: {
            required: true,
            type: Array
        },
        countries: {
            required: true,
            type: Array
        },
        graduatedCourses: {
            required: true,
            type: Array
        },
    },

    data() {
        return {
            form: this.$inertia.form({
                type: 'graduate',
                course_id: '',
                graduation_year: '',
                first_name: '',
                last_name: '',
                middle_name: '',
                educational_level: '',
                gender: '',
                current_employee: '',
                position: '',
                phone_number: '',
                email: '',
                city: '',
                country: 'Tanzania',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
