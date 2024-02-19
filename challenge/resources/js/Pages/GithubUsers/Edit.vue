<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {ref} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    githubUser: Object
})

const login = ref<HTMLInputElement | null>(null);
const email = ref<HTMLInputElement | null>(null);
const name = ref<HTMLInputElement | null>(null);
const avatar_url = ref<HTMLInputElement | null>(null);
const html_url = ref<HTMLInputElement | null>(null);
const location = ref<HTMLInputElement | null>(null);
const bio = ref<HTMLInputElement | null>(null);
const public_repos = ref<HTMLInputElement | null>(null);
const public_gists = ref<HTMLInputElement | null>(null);
const followers = ref<HTMLInputElement | null>(null);
const following = ref<HTMLInputElement | null>(null);
const selectedAdminUserRef = ref<Object>(props.githubUser)

const form = useForm({
    login: selectedAdminUserRef.value.login,
    email: selectedAdminUserRef.value.email,
    name: selectedAdminUserRef.value.name,
    avatar_url: selectedAdminUserRef.value.avatar_url,
    html_url: selectedAdminUserRef.value.html_url,
    location: selectedAdminUserRef.value.location,
    bio: selectedAdminUserRef.value.bio,
    public_repos: selectedAdminUserRef.value.public_repos.toString(),
    public_gists: selectedAdminUserRef.value.public_gists.toString(),
    followers: selectedAdminUserRef.value.followers.toString(),
    following: selectedAdminUserRef.value.following.toString(),
});

</script>

<template>
    <Head title="EditAdminUser" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Github User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Edit Github User</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Edit github user by filling out the form.
                            </p>
                        </header>

                        <form @submit.prevent="form.patch(route('update.github.user', {id: selectedAdminUserRef.id}))" class="mt-6 space-y-6">

                            <div class="flex min-w-0 gap-x-6">
                                <img class="h-20 w-20 flex-none rounded-full bg-gray-50" :src="form.avatar_url" alt="" />
                                <div class="min-w-0 flex-auto mt-6">
                                    <p class="text-lg font-semibold leading-6 text-gray-900">{{ form.login }}</p>
                                </div>
                            </div>

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
                                    autocomplete="email"
                                />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div>
                                <InputLabel for="html_url" value="Html_url" />

                                <TextInput
                                    id="html_url"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.html_url"
                                    autofocus
                                    autocomplete="html_url"
                                />

                                <InputError class="mt-2" :message="form.errors.html_url" />
                            </div>

                            <div>
                                <InputLabel for="location" value="Location" />

                                <TextInput
                                    id="location"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.location"
                                    autofocus
                                    autocomplete="location"
                                />

                                <InputError class="mt-2" :message="form.errors.location" />
                            </div>

                            <div>
                                <InputLabel for="bio" value="Bio" />

                                <TextInput
                                    id="bio"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.bio"
                                    autofocus
                                    autocomplete="bio"
                                />

                                <InputError class="mt-2" :message="form.errors.bio" />
                            </div>

                            <div>
                                <InputLabel for="public_repos" value="Public repositories" />

                                <TextInput
                                    id="public_repos"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.public_repos"
                                    autofocus
                                    autocomplete="public_repos"
                                />

                                <InputError class="mt-2" :message="form.errors.public_repos" />
                            </div>

                            <div>
                                <InputLabel for="public_gists" value="Public gists" />

                                <TextInput
                                    id="public_gists"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.public_gists"
                                    autofocus
                                    autocomplete="public_gists"
                                />

                                <InputError class="mt-2" :message="form.errors.public_gists" />
                            </div>

                            <div>
                                <InputLabel for="followers" value="Followers" />

                                <TextInput
                                    id="followers"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.followers"
                                    autofocus
                                    autocomplete="followers"
                                />

                                <InputError class="mt-2" :message="form.errors.followers" />
                            </div>

                            <div>
                                <InputLabel for="following" value="Following" />

                                <TextInput
                                    id="following"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.following"
                                    autofocus
                                    autocomplete="following"
                                />

                                <InputError class="mt-2" :message="form.errors.following" />
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
