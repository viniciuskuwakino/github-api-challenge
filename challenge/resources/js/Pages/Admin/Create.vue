<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import {ref} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

const name = ref<HTMLInputElement | null>(null);
const email = ref<HTMLInputElement | null>(null);
const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const createAdminUser = () => {
    form.post(route('store.admin.user'), {
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value?.focus();
            }
        },
    });


};
</script>

<template>
    <Head title="CreateAdminUser" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Admin User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">New Admin User</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Create new admin user by filling out the form.
                            </p>
                        </header>

                        <form @submit.prevent="createAdminUser" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Email" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="username"
                                />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div>
                                <InputLabel for="password" value="New Password" />

                                <TextInput
                                    id="password"
                                    ref="passwordInput"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="new-password"
                                />

                                <InputError :message="form.errors.password" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="password_confirmation" value="Confirm Password" />

                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="new-password"
                                />

                                <InputError :message="form.errors.password_confirmation" class="mt-2" />
                            </div>

<!--                            <div v-if="mustVerifyEmail && user.email_verified_at === null">-->
<!--                                <p class="text-sm mt-2 text-gray-800">-->
<!--                                    Your email address is unverified.-->
<!--                                    <Link-->
<!--                                        :href="route('verification.send')"-->
<!--                                        method="post"-->
<!--                                        as="button"-->
<!--                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
<!--                                    >-->
<!--                                        Click here to re-send the verification email.-->
<!--                                    </Link>-->
<!--                                </p>-->

<!--                                <div-->
<!--                                    v-show="status === 'verification-link-sent'"-->
<!--                                    class="mt-2 font-medium text-sm text-green-600"-->
<!--                                >-->
<!--                                    A new verification link has been sent to your email address.-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Create</PrimaryButton>

<!--                                <Transition-->
<!--                                    enter-active-class="transition ease-in-out"-->
<!--                                    enter-from-class="opacity-0"-->
<!--                                    leave-active-class="transition ease-in-out"-->
<!--                                    leave-to-class="opacity-0"-->
<!--                                >-->
<!--                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>-->
<!--                                </Transition>-->
                            </div>
                        </form>

                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
