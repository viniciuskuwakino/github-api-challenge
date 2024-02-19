<script setup lang="ts">
import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CustomButton from "@/Components/CustomButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";

defineProps({
    users: Array,
    id: Number
})

const confirmingUserDeletion = ref(false);
const userDeletion = ref<Object>(null);
const form = useForm({});


const confirmUserDeletion = (user) => {
    confirmingUserDeletion.value = true;
    userDeletion.value = user
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
};

function deleteAdminUser() {
    form.delete(route('destroy.admin.user', userDeletion.value['id']), {
        onSuccess: () => closeModal()
    });
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Page</h2>

                <div class="items-center gap-4">

                    <Link :href="route('create.admin.user')">
                        <CustomButton>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1.7em" viewBox="0 0 448 512" style="margin-right:8px; ">
                                <path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                            </svg>
                            Admin User
                        </CustomButton>
                    </Link>

                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 light:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 light:bg-gray-700 light:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="user in users" :key="user['id']">
                                        <tr class="bg-white border-b light:bg-gray-800 light:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap light:text-white">
                                                {{ user['name'] }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ user['email'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex space-x-4 ">
                                                    <Link :href="route('edit.admin.user', {id: user['id']})">
                                                        <button>
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                                                <path fill="#FFD43B" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                                            </svg>
                                                        </button>
                                                    </Link>

                                                    <button @click="confirmUserDeletion(user)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                                                            <path fill="#e84545" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>

                                    <Modal :show="confirmingUserDeletion" @close="closeModal">
                                        <div class="p-6">
                                            <h2 class="text-lg font-medium text-gray-900">
                                                Are you sure you want to delete {{userDeletion['name']}}?
                                            </h2>

                                            <div class="mt-6 flex justify-center">
                                                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                                                <DangerButton
                                                    class="ms-3"
                                                    @click="deleteAdminUser"
                                                >
                                                    Delete Admin User
                                                </DangerButton>
                                            </div>
                                        </div>
                                    </Modal>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
