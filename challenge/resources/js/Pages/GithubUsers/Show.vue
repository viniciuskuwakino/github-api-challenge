<script setup lang="ts">
import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    githubUsers: Array,
})

const confirmingUserDeletion = ref(false);
const userDeletion = ref<Object>(null);

const name = ref<HTMLInputElement | null>(null);

const form = useForm({
    name: '',
});


const confirmUserDeletion = (user) => {
    confirmingUserDeletion.value = true;
    userDeletion.value = user
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
};


function searchGithubUser() {
    form.post(route('store.github.user'), {
        onSuccess: () => {
            form.reset();
        }
    })
};

function deleteGithubUser() {
    form.delete(route('destroy.github.user', userDeletion.value['id']), {
        onSuccess: () => closeModal()
    });
}


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">GitHub's Users Search</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="relative overflow-x-auto">

                            <form class="max-w-md mx-auto mt-1 mb-1" @submit.prevent="searchGithubUser">
                                    <div class="flex">
                                        <div class="relative flex-1 w-full">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 light:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </div>

                                            <TextInput
                                                id="name"
                                                type="text"
                                                class="mt-1 block w-full ps-10"
                                                v-model="form.name"
                                                required
                                                autofocus
                                                autocomplete="name"
                                                placeholder="Search GitHub' Users..."
                                            />

                                            <PrimaryButton class="absolute end-1 bottom-1">Search</PrimaryButton>
                                        </div>

                                    </div>

                            </form>

                            <ul role="list" class="divide-y divide-gray-100">
                                <li v-for="user in githubUsers" :key="user.id" class="flex justify-between gap-x-6 py-5">
                                    <div class="flex min-w-0 gap-x-6">
                                        <img class="h-20 w-20 flex-none rounded-full bg-gray-50" :src="user['avatar_url']" alt="" />
                                        <div class="min-w-0 flex-auto">
                                            <p class="text-lg font-semibold leading-6 text-gray-900">{{ user['login'] }}</p>
                                            <p class="mt-1 truncate text-sm leading-5 text-gray-500">Name: {{ user['name'] }}</p>
                                            <p class="mt-0 truncate text-sm leading-5 text-gray-500">Github URL: {{ user['html_url'] }}</p>
                                            <p class="mt-0 truncate text-sm leading-5 text-gray-500">Public repositories: {{ user['public_repos'] }}</p>
                                        </div>
                                    </div>

                                    <div class="hidden shrink-0 sm:flex sm:flex-row gap-x-4 sm:items-center mr-14">
                                        <Link :href="route('show.github.user', {id: user['id']})">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                    <path fill="#1499ff" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                                                </svg>
                                            </button>
                                        </Link>

                                        <Link :href="route('edit.github.user', {id: user['id']})">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                    <path fill="#FFD43B" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                                </svg>
                                            </button>
                                        </Link>

                                        <button @click="confirmUserDeletion(user)">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                <path fill="#e84545" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            </ul>

                            <Modal :show="confirmingUserDeletion" @close="closeModal">
                                <div class="p-6">
                                    <h2 class="text-lg font-medium text-gray-900">
                                        Are you sure you want to delete {{userDeletion['name']}}?
                                    </h2>

                                    <div class="mt-6 flex justify-center">
                                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                                        <DangerButton
                                            class="ms-3"
                                            @click="deleteGithubUser"
                                        >
                                            Delete Github User
                                        </DangerButton>
                                    </div>
                                </div>
                            </Modal>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
