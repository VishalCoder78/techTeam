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
            items: [],
            title: "",
            showDiv1: false,
            showDiv2: false,
            showDiv3: false,
            showDiv4: false,
            showDiv5: false,
            addListModel: false,
            lists: [],
            cards: [],
        };
    },
    mounted() {
        this.fetchLists();
        this.fetchCards();
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
        addListToggle() {
            this.addListModel = !this.addListModel;
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
        Add_card() {
            const data = {
                title: this.title,
                list: this.list,
            };

            axios.post('/add-card', data)
                .then(response => {
                    console.log('submit');
                })
                .catch(error => {
                    console.error(error);
                });
        },

        Add_list() {
            const data = {
                title: this.title,
                list: this.list,
            };

            axios.post('/add-list', data)
                .then(response => {
                    console.log('submit');
                })
                .catch(error => {
                    console.error(error);
                });
        },

        fetchCards() {
            axios.get('http://localhost:8000/api/card')
                .then(response => {
                    this.cards = response.data;
                    // console.log(this.cards)
                })
                .catch(error => {
                    console.log(error);
                });
        },

        fetchLists() {
            axios.get('http://localhost:8000/api/list')
                .then(response => {
                    this.items = response.data;
                    // console.log(this.items)
                })
                .catch(error => {
                    console.log(error);
                });
        },

    },
};

</script>

<template>
    <AppLayout title="Board">
        <div class="h-[90vh] overflow-x-auto ">
            <div class="grid grid-flow-col auto-cols-max">

                <div class="w-60 rounded-lg bg-gray-200 m-4 py-4 px-1 h-max-[85vh]" v-for="item in items" :key="item.id">
                    <div class="flex justify-between">
                        <button value="list 1" class="py-0 px-1 mx-2 my-auto border-none">{{ item.title }}</button>
                        <button class="mr-3 hover:bg-gray-300 px-3 py-2.5 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-three-dots" viewBox="0 0 16 16">
                                <path
                                    d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                            </svg>
                        </button>
                    </div>
                    <draggable :list="cards" class="drag-area max-h-[60vh] overflow-auto "
                        :options="{ animation: 200, group: 'status' }" @change="onItemChange" group="todo">
                        <template #item="{ element }" class="">
                            <ul class="max-h-vh grid">
                                <li class="m-2 p-2 bg-white rounded-md shadow-md">
                                    <div class="flex justify-between">
                                        <p class="font-thin text-sm text-gray-600">#Demo</p>
                                        <button class="hover:bg-gray-300 p-2 rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit-2">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div :key="element.id">
                                        <p>
                                            {{ element.title }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </template>
                    </draggable>

                    <!-- Add cart button -->
                    <div class="mx-2  rounded-md pt-1" v-show="showDiv1 == false">
                        <button @click="toggleDiv1" class="hover:bg-gray-300 w-full rounded-md pt-1">
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

                    <!-- Add cart form -->
                    <div class="border-none" v-show="showDiv1">
                        <form @submit.prevent="Add_card">

                            <div class="m-2">
                                <textarea type="text" v-model="title" class="p-2 w-full rounded-md border-none shadow-md"
                                    placeholder="Enter a title for this card"></textarea>
                                <input type="text" class="hidden" name="list" value="item.title">
                                <button type="submit" class="px-2 py-1 bg-blue-600 mx-3 rounded-md">Add Cart</button>
                                <button class="" @click="toggleDiv1"><svg xmlns="http://www.w3.org/2000/svg" width="28"
                                        height="28" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg></button>
                            </div>
                        </form>
                    </div>
                </div>



                <!-- Add another list button -->
                <div class="m-4 w-full" v-show="!addListModel">
                    <button class="bg-gray-200 rounded-md shadow-md px-2 pt-2" @click="addListToggle">
                        <span style="display: inline-flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            <span style="margin-left: 5px;" class="w-max">Add another list</span>
                        </span>
                    </button>
                </div>
                <!-- Add another card form -->
                <div>
                    <div class="border-none" v-show="addListModel">
                        <form @submit.prevent="Add_list">

                            <div class="m-2">
                                <input type="text" v-model="title" class="p-2 w-full rounded-md border-none shadow-md"
                                    placeholder="Enter a title for this card" />
                                <button type="submit" @click="addListToggle"
                                    class="px-2 py-1 bg-blue-600 mx-3 rounded-md">Add Cart</button>
                            </div>
                        </form>
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
  