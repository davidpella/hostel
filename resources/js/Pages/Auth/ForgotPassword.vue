<template>
    <Head title="Forgot Password" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

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

        <div class="w-1/2 overflow-y-auto flex flex-col sm:justify-center">
            <form @submit.prevent="submit" class="px-32 py-16">
                <header class="mb-12 flex space-x-4">
                    <Link href="/">
                        <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                    </Link>

                    <div>
                        <h1 class="text-lg text-gray-800 font-bold">
                            Forgot Password
                        </h1>

                        <p class="mt-2 text-sm text-gray-600 font-normal">
                            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                        </p>
                    </div>
                </header>

                <div>
                    <BreezeLabel for="email" value="Email" />
                    <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </BreezeButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeApplicationLogo from "@/Components/ApplicationLogo";

export default {
    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
        BreezeApplicationLogo,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
