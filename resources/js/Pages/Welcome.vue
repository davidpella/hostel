<template>
    <Head>
        <title>Welcome</title>

        <meta name="description" content="Your page description">
    </Head>

    <div class="relative flex items-top justify-center min-h-screen bg-white dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="user" :href="route('applications.index')" class="text-sm text-gray-700 underline">
                Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </Link>

                <Link v-if="canApply" :href="route('applications')" class="ml-4 text-sm text-gray-700 underline">
                    Hostel Application
                </Link>
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <header class="px-6">
                <h1 class="text-5xl font-black">Accommodation</h1>
            </header>

            <div class="flex mt-12">
                <div class="w-1/2 px-6">
                    <div class="space-y-6">
                        <p class="text-lg text-gray-700 leading-7">
                            The university provides hostels for both male and female students, although not enough to
                            accommodate all students admitted in the university. The Student's hostel are located opposite
                            existing main Kairuki hospital and university building in Mikocheni, Kinondoni district,
                            Dar es salaam.
                        </p>

                        <p class="text-lg text-gray-700 leading-7">
                            Alternative private accommodation is also available within the university proximity. A variety
                            of recreational facilities are also available.
                        </p>

                        <footer class="bg-gray-50 space-y-6 px-8 py-6 rounded-md overflow-hidden">
                            <h3>
                                <span class="text-gray-500">
                                    Contact person:
                                </span>
                                <span class="text-sm font-bold uppercase tracking-wide text-gray-700">
                                    Alex Gabriel
                                </span>
                            </h3>

                            <div class="space-y-3">
                                <div class="flex space-x-3">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                    </div>

                                    <div class="flex flex-col space-y-1">
                                        <a
                                            class="text-sm text-gray-700 font-medium tabular-nums"
                                            href="tel:+255 713 227 170"
                                        >
                                            +255 713 227 170
                                        </a>
                                        <a
                                            class="text-sm text-gray-700 font-medium tabular-nums"
                                            href="tel:+255 624 086 331"
                                        >
                                            +255 624 086 331
                                        </a>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <a
                                            class="text-sm text-gray-700 font-medium"
                                            href="mailto:alex.gabriel@hkmu.ac.tz"
                                        >alex.gabriel@hkmu.ac.tz</a>
                                    </div>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>

                <div class="w-1/2 px-6">
                    <img
                        src="http://www.hkmu.ac.tz/images/accomodation.jpg"
                        alt="Accommodation Image"
                        class="h-full rounded-lg object-cover"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { computed } from "vue";
    import { Head, Link, usePage } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        canLogin: {
            required: true,
            type: Boolean,
        },
        canApply: {
            required: true,
            type: Boolean,
        },
    });

    const user = computed(() => {
        return usePage().props.value.auth.user;
    });
</script>
