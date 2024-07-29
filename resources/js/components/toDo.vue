<template>
    <section
        id="todo"
        class="border-2 border-red-300 flex flex-col justify-center items-center w-6/5 h-auto overflow-y-auto py-4 rounded-md bg-red-500/25"
    >
        <div class="w-full">
            <h1
                class="ml-8 my-2 text-2xl font-bold text-red-950 dark:text-red-400"
            >
                Pending
            </h1>
        </div>
        <div
            v-for="task in pendingTasks"
            :key="task.id"
            class="border-2 border-slate-400 bg-zinc-50 flex flex-col justify-center items-center w-11/12 py-2 px-2 my-2 rounded-md"
        >
            <div
                class="w-full h-fit text-md font-semibold flex justify-start items-center"
            >
                <h3 class="text-lg w-1/2 text-left">{{ task.title }}</h3>
                <div class="flex justify-end items-center w-1/2 pr-4 gap-4">
                    <div class="relative">
                        <a
                            href="#"
                            @click.stop.prevent="toggleOptions(task.id)"
                            class="text-md text-lg text-zinc-500"
                        >
                            &#x260D;
                            <options
                                v-if="showOptions[task.id]"
                                :taskId="task.id"
                                @change-status="changeTaskStatus"
                                @edit-task="editTask(task.id)"
                                class="absolute top-full right-0 mt-1"
                            />
                        </a>
                    </div>
                    <a
                        href="#"
                        @click.prevent="deleteTask(task.id)"
                        class="text-md text-lg text-red-800"
                        >&#x2715;</a
                    >
                </div>
            </div>
            <div class="w-full h-fit py-1">
                <p
                    class="text-md font-medium text-zinc-500 w-full h-fit text-left"
                >
                    {{ task.description }}
                </p>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import options from "./options.vue";

export default {
    components: { options },
    name: "toDo",
    props: ["tasks"],
    data() {
        return {
            showOptions: {},
        };
    },
    computed: {
        pendingTasks() {
            return this.tasks.filter((task) => task.status === "pending");
        },
    },
    methods: {
        toggleOptions(taskId) {
            console.log("Toggle options called for task:", taskId);
            this.$set(this.showOptions, taskId, !this.showOptions[taskId]);
            console.log("Show options state:", this.showOptions);

            // Close other open options
            Object.keys(this.showOptions).forEach((key) => {
                if (key !== taskId.toString()) {
                    this.$set(this.showOptions, key, false);
                }
            });
        },

        closeOptions(event) {
            if (
                !event.target.closest(".options-component") &&
                !event.target.closest('a[href="#"]')
            ) {
                this.showOptions = {};
            }
        },

        deleteTask(taskId) {
            this.$emit("delete-task", taskId);
        },
        async changeTaskStatus({ taskId, newStatus }) {
            try {
                await axios.patch(`/tasks/${taskId}`, { status: newStatus });
                this.$emit("task-updated");
            } catch (error) {
                console.error("Error updating task status:", error);
            }
        },
        editTask(taskId) {
            console.log("Edit task", taskId);
        },
    },
    mounted() {
        document.addEventListener("click", this.closeOptions);
    },
    beforeUnmount() {
        document.removeEventListener("click", this.closeOptions);
    },
};
</script>
