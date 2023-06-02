<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue';
import draggable from "vuedraggable";
import axios from "axios";



export default {
    components: {
        AppLayout,
        draggable,
    },
    props: ["tasksCompleted", "tasksNotCompleted"],
    data() {
        return {
            Backlog: [
                { id: 1, text: "Backlog 1" },
                { id: 2, text: "Backlog 2" },
                { id: 3, text: "Backlog 3" },
            ],
            Todo: [
                { id: 1, text: "Todo 1" },
                { id: 2, text: "Todo 2" },
                { id: 3, text: "Todo 3" },
            ],
            Process: [
                { id: 1, text: "Process 1" },
                { id: 2, text: "Process 2" },
                { id: 3, text: "Process 3" },
            ],
            Review: [
                { id: 1, text: "Review 1" },
                { id: 2, text: "Review 2" },
                { id: 3, text: "Review 3" },
            ],
            Done: [
                { id: 1, text: "Done 1" },
                { id: 2, text: "Done 2" },
                { id: 3, text: "Done 3" },
            ],
            showDiv1: false,
            showDiv2: false,
            showDiv3: false,
            showDiv4: false,
            showDiv5: false,
        };
    },
    methods: {
        toggleDiv1() {
            this.showDiv1 = !this.showDiv1;
        },
        toggleDiv2() {
            this.showDiv2 = !this.showDiv2;
        },
        toggleDiv3() {
            this.showDiv3 = !this.showDiv3;
        },
        toggleDiv4() {
            this.showDiv4 = !this.showDiv4;
        },
        toggleDiv5() {
            this.showDiv5 = !this.showDiv5;
        },
        onItemChange() {
            // Update the tasks based on the current items in both sections
            const tasksNotCompleted = this.upcomingItems.map((item, index) => {
                return {
                    ...item,
                    order: index + 1,
                };
            });

            const tasksCompleted = this.completedItems.map((item, index) => {
                return {
                    ...item,
                    order: index + 1,
                };
            });

            const tasks = [...tasksNotCompleted, ...tasksCompleted];

            axios
                .put("/demos/tasks/updateAll", {
                    tasks: tasks,
                })
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });

        },
    },
};

</script>

<template>
    <AppLayout title="Board">
        <div class="flex">

            <div class="w-60 rounded-lg bg-gray-200 m-4 py-4 px-1 h-max">
                <div class="flex justify-between ">
                    <button value="list 1" class="py-0 px-1 mx-2 my-auto border-none">Backlog</button>
                    <button class="mr-3 hover:bg-gray-300 px-3 py-2.5 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path
                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                        </svg>
                    </button>
                </div>
                <draggable :list="Backlog" class="drag-area" :options="{ animation: 200, group: 'status' }"
                    @change="onItemChange" group="todo">
                    <template #item="{ element }">
                        <ul class="max-h-vh overflow-x-auto">
                            <li class="m-2 p-2 bg-white rounded-md shadow-md">
                                <div class="flex justify-between">
                                    <p class="font-thin text-sm text-gray-600">#Demo</p>
                                    <button class="hover:bg-gray-300 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-edit-2">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div :key="element.id">
                                    <p>
                                        {{ element.text }}
                                    </p>
                                </div>
                                <div>
                                    <div class="flex justify-between">
                                        <div class="bg-red-600 w-max p-0.5 px-1.5 rounded-md">
                                            <span style="display: inline-flex; align-items: center;">
                                                <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="12"
                                                    height="12" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"
                                                        fill="white"></path>
                                                </svg>
                                            </span>
                                            <span style="margin-left: 5px;" class="text-white">2</span>
                                        </div>
                                        <div class="flex">
                                            <img src="https://ui-avatars.com/api/?name=Vishal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Ujjwal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Roachak+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </template>
                </draggable>
                <div class="mx-2 hover:bg-gray-300 rounded-md pt-1" v-show="showDiv1 == false">
                    <button @click="toggleDiv1">
                        <span style="display: inline-flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <span style="margin-left: 5px;">Add a card</span>
                        </span>
                    </button>
                </div>

                <div class="border-none" v-show="showDiv1">
                    <div class="m-2">
                        <!-- <textarea type="text" class="p-2 w-full rounded-md border-none shadow-md"
                                                            placeholder="Enter a title for this card" /> -->
                        <textarea type="text" class="p-2 w-full rounded-md border-none shadow-md"
                            placeholder="Enter a title for this card" />
                    </div>
                    <div class="flex items-center">
                        <button class="px-2 py-1 bg-blue-600 mx-3 rounded-md">Add Cart</button>
                        <button class="" @click="toggleDiv1"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg></button>
                    </div>
                </div>
            </div>
            <div class="w-60 rounded-lg bg-gray-200 m-4 py-4 px-1 h-max">
                <div class="flex justify-between ">
                    <button value="list 1" class="py-0 px-1 mx-2 my-auto border-none">Todo</button>
                    <button class="mr-3 hover:bg-gray-300 px-3 py-2.5 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path
                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                        </svg>
                    </button>
                </div>
                <draggable :list="Todo" class="drag-area" :options="{ animation: 200, group: 'status' }"
                    @change="onItemChange" group="todo">
                    <template #item="{ element }">
                        <ul>
                            <li class="m-2 p-2 bg-white rounded-md shadow-md">
                                <div class="flex justify-between">
                                    <p class="font-thin text-sm text-gray-600">#Demo</p>
                                    <button class="hover:bg-gray-300 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-edit-2">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div :key="element.id">
                                    <p>
                                        {{ element.text }}
                                    </p>
                                </div>
                                <div>
                                    <div class="flex justify-between">
                                        <div class="bg-red-600 w-max p-0.5 px-1.5 rounded-md">
                                            <span style="display: inline-flex; align-items: center;">
                                                <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="12"
                                                    height="12" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"
                                                        fill="white"></path>
                                                </svg>
                                            </span>
                                            <span style="margin-left: 5px;" class="text-white">2</span>
                                        </div>
                                        <div class="flex">
                                            <img src="https://ui-avatars.com/api/?name=Vishal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Ujjwal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Roachak+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">

                                        </div>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </template>
                </draggable>
                <div class="mx-2 hover:bg-gray-300 rounded-md pt-1" v-show="showDiv2 == false">
                    <button @click="toggleDiv2">
                        <span style="display: inline-flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <span style="margin-left: 5px;">Add a card</span>
                        </span>
                    </button>
                </div>

                <div class="border-none" v-show="showDiv2">
                    <div class="m-2">
                        <textarea type="text" class="p-2 w-full rounded-md border-none shadow-md"
                            placeholder="Enter a title for this card" />
                    </div>
                    <div class="flex items-center">
                        <button class="px-2 py-1 bg-blue-600 mx-3 rounded-md">Add Cart</button>
                        <button class="" @click="toggleDiv2"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg></button>
                    </div>
                </div>

            </div>
            <div class="w-60 rounded-lg bg-gray-200 m-4 py-4 px-1 h-max">
                <div class="flex justify-between ">
                    <button value="list 1" class="py-0 px-1 mx-2 my-auto border-none">Process</button>
                    <button class="mr-3 hover:bg-gray-300 px-3 py-2.5 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path
                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                        </svg>
                    </button>
                </div>
                <draggable :list="Process" class="drag-area" :options="{ animation: 200, group: 'status' }"
                    @change="onItemChange" group="todo">
                    <template #item="{ element }">
                        <ul>
                            <li class="m-2 p-2 bg-white rounded-md shadow-md">
                                <div class="flex justify-between">
                                    <p class="font-thin text-sm text-gray-600">#Demo</p>
                                    <button class="hover:bg-gray-300 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-edit-2">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div :key="element.id">
                                    <p>
                                        {{ element.text }}
                                    </p>
                                </div>
                                <div>
                                    <div class="flex justify-between">
                                        <div class="bg-red-600 w-max p-0.5 px-1.5 rounded-md">
                                            <span style="display: inline-flex; align-items: center;">
                                                <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="12"
                                                    height="12" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"
                                                        fill="white"></path>
                                                </svg>
                                            </span>
                                            <span style="margin-left: 5px;" class="text-white">2</span>
                                        </div>
                                        <div class="flex">
                                            <img src="https://ui-avatars.com/api/?name=Vishal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Ujjwal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Roachak+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">

                                        </div>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </template>
                </draggable>
                <div class="mx-2 hover:bg-gray-300 rounded-md pt-1" v-show="showDiv3 == false">
                    <button @click="toggleDiv3">
                        <span style="display: inline-flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <span style="margin-left: 5px;">Add a card</span>
                        </span>
                    </button>
                </div>

                <div class="border-none" v-show="showDiv3">
                    <div class="m-2">
                        <textarea type="text" class="p-2 w-full rounded-md border-none shadow-md"
                            placeholder="Enter a title for this card" />
                    </div>
                    <div class="flex items-center">
                        <button class="px-2 py-1 bg-blue-600 mx-3 rounded-md">Add Cart</button>
                        <button class="" @click="toggleDiv3"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg></button>
                    </div>
                </div>

            </div>
            <div class="w-60 rounded-lg bg-gray-200 m-4 py-4 px-1 h-max">
                <div class="flex justify-between ">
                    <button value="list 1" class="py-0 px-1 mx-2 my-auto border-none">Review</button>
                    <button class="mr-3 hover:bg-gray-300 px-3 py-2.5 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path
                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                        </svg>
                    </button>
                </div>
                <draggable :list="Review" class="drag-area" :options="{ animation: 200, group: 'status' }"
                    @change="onItemChange" group="todo">
                    <template #item="{ element }">
                        <ul>
                            <li class="m-2 p-2 bg-white rounded-md shadow-md">
                                <div class="flex justify-between">
                                    <p class="font-thin text-sm text-gray-600">#Demo</p>
                                    <button class="hover:bg-gray-300 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-edit-2">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div :key="element.id">
                                    <p>
                                        {{ element.text }}
                                    </p>
                                </div>
                                <div>
                                    <div class="flex justify-between">
                                        <div class="bg-red-600 w-max p-0.5 px-1.5 rounded-md">
                                            <span style="display: inline-flex; align-items: center;">
                                                <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="12"
                                                    height="12" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"
                                                        fill="white"></path>
                                                </svg>
                                            </span>
                                            <span style="margin-left: 5px;" class="text-white">2</span>
                                        </div>
                                        <div class="flex">
                                            <img src="https://ui-avatars.com/api/?name=Vishal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Ujjwal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Roachak+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">

                                        </div>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </template>
                </draggable>
                <div class="mx-2 hover:bg-gray-300 rounded-md pt-1" v-show="showDiv4 == false">
                    <button @click="toggleDiv4">
                        <span style="display: inline-flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <span style="margin-left: 5px;">Add a card</span>
                        </span>
                    </button>
                </div>

                <div class="border-none" v-show="showDiv4">
                    <div class="m-2">
                        <textarea type="text" class="p-2 w-full rounded-md border-none shadow-md"
                            placeholder="Enter a title for this card" />
                    </div>
                    <div class="flex items-center">
                        <button class="px-2 py-1 bg-blue-600 mx-3 rounded-md">Add Cart</button>
                        <button class="" @click="toggleDiv4"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg></button>
                    </div>
                </div>

            </div>
            <div class="w-60 rounded-lg bg-gray-200 m-4 py-4 px-1 h-max">
                <div class="flex justify-between ">
                    <button value="list 1" class="py-0 px-1 mx-2 my-auto border-none">Done</button>
                    <button class="mr-3 hover:bg-gray-300 px-3 py-2.5 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path
                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                        </svg>
                    </button>
                </div>
                <draggable :list="Done" class="drag-area" :options="{ animation: 200, group: 'status' }"
                    @change="onItemChange" group="todo">
                    <template #item="{ element }">
                        <ul>
                            <li class="m-2 p-2 bg-white rounded-md cursor-pointer shadow-md">
                                <div class="flex justify-between">
                                    <p class="font-thin text-sm text-gray-600">#Demo</p>
                                    <button class="hover:bg-gray-300 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-edit-2">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div :key="element.id">
                                    <p>
                                        {{ element.text }}
                                    </p>
                                </div>
                                <div>
                                    <div class="flex justify-between">
                                        <div class="bg-red-600 w-max p-0.5 px-1.5 rounded-md">
                                            <span style="display: inline-flex; align-items: center;">
                                                <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="12"
                                                    height="12" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"
                                                        fill="white"></path>
                                                </svg>
                                            </span>
                                            <span style="margin-left: 5px;" class="text-white">2</span>
                                        </div>
                                        <div class="flex">
                                            <img src="https://ui-avatars.com/api/?name=Vishal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Ujjwal+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">
                                            <img src="https://ui-avatars.com/api/?name=Roachak+Singh&size=26&background=random&rounded=true"
                                                alt="" class="mx-0.5">

                                        </div>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </template>
                </draggable>
                <div class="mx-2 hover:bg-gray-300 rounded-md pt-1" v-show="showDiv5 == false">
                    <button class="w-full" @click="toggleDiv5">
                        <span style="display: inline-flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <span style="margin-left: 5px;">Add a card</span>
                        </span>
                    </button>
                </div>

                <div class="border-none" v-show="showDiv5">
                    <div class="m-2">
                        <textarea type="text" class="p-2 w-full rounded-md border-none shadow-md"
                            placeholder="Enter a title for this card" />
                    </div>
                    <div class="flex items-center">
                        <button class="px-2 py-1 bg-blue-600 mx-3 rounded-md">Add Cart</button>
                        <button class="" @click="toggleDiv5"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg></button>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
  
<style>
.drag-area {
    min-height: 10px;
}
</style>
  