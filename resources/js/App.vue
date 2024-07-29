<template>
    <Sidebar @toggleForm2="toggleForm2" @user-logged-in="updateUser" />
    <div
        class="w-10/12 h-screen py-5 px-9 flex flex-col justify-start items-start relative"
    >
        <TaskPageNav @toggleForm="toggleForm" :user="user" />
        <div class="w-full h-auto flex justify-around items-start my-4">
            <ToDo
                :tasks="tasks"
                @delete-task="deleteTask"
                @task-updated="fetchTasks"
            />
            <Progress />
            <Done />
        </div>

        <!-- Task submission form -->
        <div
            v-if="showForm"
            @click.self="hideForm"
            id="form"
            class="w-full h-screen py-5 px-9 flex justify-center items-center absolute top-0 left-0 bg-blue-500/15 backdrop-blur-md"
        >
            <form
                @submit.prevent="submitForm"
                class="w-4/12 h-fit border-2 border-slate-400 rounded-lg gap-4 flex flex-col justify-center items-center py-6 px-6 bg-slate-700"
            >
                <p class="text-xl font-bold text-white">Add new task!</p>
                <input
                    v-model="task.title"
                    type="text"
                    required
                    placeholder="Heading"
                    class="w-full h-1/5 border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2 placeholder:text-blue-950 font-semibold outline-none"
                />
                <input
                    v-model="task.description"
                    type="text"
                    required
                    placeholder="Description"
                    class="w-full h-2/5 border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2 placeholder:text-blue-950 font-semibold outline-none"
                />
                <input v-model="task.due_date" type="date" class="..." />

                <button
                    type="submit"
                    class="border-2 border-green-400 bg-green-300 py-1 px-4 text-green-950 rounded-md font-medium text-lg"
                >
                    submit!
                </button>
            </form>
        </div>

        <!-- User creation form -->
        <div
            v-if="showUForm"
            @click.self="hideForm2"
            id="form"
            class="w-full h-screen py-5 px-9 flex justify-center items-center absolute top-0 left-0 bg-blue-500/15 backdrop-blur-md"
        >
            <CreatUser />
        </div>
    </div>
</template>

<script>
import Sidebar from "./components/sidebar.vue";
import TaskPageNav from "./components/taskPageNav.vue";
import ToDo from "./components/toDo.vue";
import Progress from "./components/progress.vue";
import Done from "./components/done.vue";
import CreatUser from "./components/creatUser.vue";
import axios from "axios"; // Ensure axios is imported

export default {
    name: "App",
    components: { TaskPageNav, ToDo, Progress, Done, Sidebar, CreatUser },
    methods: {
        toggleForm() {
            this.showForm = !this.showForm;
        },
        updateUser(userData) {
            this.user = userData;
            this.fetchTasks();
        },
        hideForm() {
            this.showForm = false;
        },
        toggleForm2() {
            this.showUForm = !this.showUForm;
        },
        hideForm2() {
            this.showUForm = false;
        },
        async fetchTasks() {
            try {
                const response = await axios.get("/tasks/pending");
                this.tasks = response.data;
            } catch (error) {
                console.error("Error fetching tasks:", error);
            }
        },
        async deleteTask(taskId) {
            try {
                await axios.delete(`/api/tasks/${taskId}`);
                this.tasks = this.tasks.filter((task) => task.id !== taskId);
            } catch (error) {
                console.error("There was an error deleting the task:", error);
            }
        },
        async submitForm() {
            try {
                if (!this.user) {
                    throw new Error("User not authenticated");
                }
                const taskData = {
                    ...this.task,
                    user_id: this.user.id, // Add this line
                };
                const response = await this.$axios.post("/tasks", taskData);
                console.log("Task created:", response.data);
                this.hideForm();
                this.resetForm();
                this.fetchTasks(); // Refresh the task list
            } catch (error) {
                console.error(
                    "Error creating task:",
                    error.response?.data || error.message
                );
                alert("Error creating task. Please try again.");
            }
        },
        async fetchTasks() {
            try {
                const response = await axios.get("/tasks/pending");
                this.tasks = response.data;
            } catch (error) {
                console.error("Error fetching tasks:", error);
            }
        },
        resetForm() {
            this.task = {
                title: "",
                description: "",
                due_date: null,
            };
        },
        async submitForm2() {
            try {
                await axios.post("/register", this.user); // Adjusted endpoint to /register
                alert("User created successfully!");
                this.resetForm2();
            } catch (error) {
                console.error(
                    "Error creating user:",
                    error.response?.data || error.message
                );
                alert("Error creating user. Please try again.");
            }
        },
        resetForm2() {
            this.user = {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            };
        },
        async signIn(email, password) {
            try {
                const response = await axios.post("/login", {
                    email,
                    password,
                });
                if (response.status === 302) {
                    this.user = response.data.user;
                    await this.fetchTasks();
                    alert("Sign in successful!");
                    this.$router.push("/");
                } else {
                    alert("Sign in successful!");
                }
            } catch (error) {
                console.error(
                    "Error signing in:",
                    error.response?.data || error.message
                );
                alert("Error signing in. Please try again.");
            }
        },
    },
    data() {
        return {
            showForm: false,
            showUForm: false,
            task: {
                title: "",
                description: "",
                due_date: null,
            },
            user: null,
            tasks: [],
        };
    },
    created() {
        const storedUser = localStorage.getItem("user");
        if (storedUser) {
            this.user = JSON.parse(storedUser);
            this.fetchTasks(); // Fetch tasks if user is already logged in
        }
    },
};
</script>
