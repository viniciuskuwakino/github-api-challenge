<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {ref} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    selectedAdminUser: Object
})

const name = ref<HTMLInputElement | null>(null);
const email = ref<HTMLInputElement | null>(null);
const selectedAdminUserRef = ref<Object>(props.selectedAdminUser)

const form = useForm({
    name: selectedAdminUserRef.value.name,
    email: selectedAdminUserRef.value.email,
});

</script>

<template>
    <Head title="EditAdminUser" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Admin User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Edit Admin User</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Edit admin user by filling out the form.
                            </p>
                        </header>

                        <form @submit.prevent="form.patch(route('update.admin.user', {id: selectedAdminUserRef.id}))" class="mt-6 space-y-6">
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

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Confirm</PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Updated.</p>
                                </Transition>
                            </div>
                        </form>

                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
