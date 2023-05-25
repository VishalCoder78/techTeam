<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue';


const state = reactive({
    isModalOpen: false,
});

const openModal = function () {
    state.isModalOpen = true;
}

const closeModal = function () {
    state.isModalOpen = false;
}

</script>

<template>
    <AppLayout title="Dashboard">
        <div class="w-80 bg-gray-100 mx-auto mt-24 p-4 rounded-md">
            <div class="flex justify-between border-b-black">
                <p class="text-4xl">Your Board</p>
                <button class="bg-blue-600 text-white px-2 rounded-md" @click="openModal">Create</button>
            </div>
            <div>
                <ul>
                    <li class="my-4  rounded-md flex justify-between">
                        <a class="p-2 bg-gray-200 w-full cursor-pointer rounded-l-md">PieCloud</a>
                        <button class="bg-green-400 px-2 rounded-r-md ">Edit</button>
                    </li>
                    <li class="my-4  rounded-md flex justify-between">
                        <a class="p-2 bg-gray-200 w-full cursor-pointer rounded-l-md">PieCloud</a>
                        <button class="bg-green-400 px-2 rounded-r-md ">Edit</button>
                    </li>
                    <li class="my-4  rounded-md flex justify-between">
                        <a class="p-2 bg-gray-200 w-full cursor-pointer rounded-l-md">PieCloud</a>
                        <button class="bg-green-400 px-2 rounded-r-md ">Edit</button>
                    </li>
                    <li class="my-4  rounded-md flex justify-between">
                        <a class="p-2 bg-gray-200 w-full cursor-pointer rounded-l-md">PieCloud</a>
                        <button class="bg-green-400 px-2 rounded-r-md ">Edit</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="block fixed h-[100vh] w-[100vw] bg-gray-200/80 top-0 z-40" v-if="state.isModalOpen == true">
            <div class="border bg-white w-[25rem] relative top-[40%] left-[35%] p-4 rounded-lg Z-50">
                <div class="w-full flex justify-end">
                    <button class="hover:bg-gray-200 rounded-full" @click="closeModal">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x"
                            viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>
                <div class="my-2">
                    <input type="text " class="border w-full py-2 rounded-md my-2 px-2" placeholder="New Name">
                    <br>
                    <button class="w-full bg-gray-800 text-gray-200 py-2 rounded-md my-2 ">Change</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
