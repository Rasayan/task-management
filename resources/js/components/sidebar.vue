<template>
    <nav
        class="w-2/12 h-screen bg-transparent block relative left-1 top-0 py-2 px-2"
    >
        <div
            class="w-full h-full py-2 px-2 bg-zinc-50 flex border-2 border-slate-500 dark:border-blue-100 dark:bg-zinc-950 flex-col justify-between items-center rounded-lg z-100"
        >
            <div class="w-full h-fit flex justify-center items-center">
                <h1 class="text-blue-900 text-4xl font-bold dark:text-blue-50">
                    Traction
                </h1>
            </div>

            <div
                class="flex flex-col justify-center items-center gap-3 w-full h-fit"
            >
                <a
                    href="#"
                    class="w-full h-fit text-center text-blue-600 dark:text-blue-300 text-xl duration-200 py-2 font-medium hover:bg-blue-500 dark:hover:text-white hover:text-white rounded-md"
                >
                    Bookmarks
                </a>
                <button
                    @click="toggleProfileOptions"
                    class="w-full h-fit text-center text-blue-600 dark:text-blue-300 text-xl duration-200 py-2 font-medium hover:bg-blue-500 dark:hover:text-white hover:text-white rounded-md"
                >
                    Profile
                </button>
            </div>

            <div
                class="flex flex-col justify-center items-center gap-3 w-full h-fit py-3"
            >
                <button
                    @click="toggleTheme"
                    id="themeButton"
                    class="text-white py-1 px-2 rounded-md dark:bg-white dark:text-white"
                >
                    {{ isDarkMode ? "Light Mode" : "Dark Mode" }}
                </button>

                <button
                    class="text-slate-100 text-lg font-semibold w-full h-fit text-center bg-slate-900 py-2 rounded-lg dark:bg-white dark:text-black dark:hover:bg-zinc-200 duration-150"
                >
                    Settings
                </button>
            </div>
        </div>

        <!-- Profile Options Modal -->
        <div
            v-if="showProfileOptions"
            @click.self="toggleProfileOptions"
            class="w-full h-screen py-5 px-9 flex justify-center items-center absolute top-0 left-0 bg-blue-500/15 backdrop-blur-md"
        >
            <div
                class="w-95 h-fit border-2 border-slate-400 rounded-lg gap-4 flex flex-col justify-center items-center py-6 px-6 bg-slate-700"
            >
                <p class="text-xl font-bold text-white mb-4">Profile Options</p>
                <button
                    @click="showSignInForm = true"
                    class="w-full h-fit text-center text-blue-600 text-xl duration-200 py-2 font-medium hover:bg-blue-500 hover:text-white rounded-md"
                >
                    Sign In
                </button>
                <button
                    @click="showSignUpForm = true"
                    class="w-full h-fit text-center text-blue-600 text-xl duration-200 py-2 font-medium hover:bg-blue-500 hover:text-white rounded-md"
                >
                    Sign Up
                </button>
            </div>
        </div>

        <!-- Sign In Form -->
        <div
            v-if="showSignInForm"
            @click.self="showSignInForm = false"
            class="w-full h-screen py-5 px-9 flex justify-center items-center absolute top-0 left-0 bg-blue-500/15 backdrop-blur-md"
        >
            <form
                @submit.prevent="submitSignIn"
                class="w-95 h-fit border-2 border-slate-400 rounded-lg gap-4 flex flex-col justify-center items-center py-6 px-6 bg-slate-700"
            >
                <p class="text-xl font-bold text-white">Sign In</p>
                <input
                    v-model="signIn.email"
                    type="email"
                    required
                    placeholder="Email"
                    class="w-full border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2 placeholder:text-blue-950 font-semibold outline-none"
                />
                <input
                    v-model="signIn.password"
                    type="password"
                    required
                    placeholder="Password"
                    class="w-full border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2 placeholder:text-blue-950 font-semibold outline-none"
                />
                <button
                    type="submit"
                    class="border-2 border-green-400 bg-green-300 py-1 px-4 text-green-950 rounded-md font-medium text-lg"
                >
                    Sign In
                </button>
            </form>
        </div>

        <!-- Sign Up Form -->
        <div
            v-if="showSignUpForm"
            @click.self="showSignUpForm = false"
            class="w-full h-screen py-5 px-9 flex justify-center items-center absolute top-0 left-0 bg-blue-500/15 backdrop-blur-md"
        >
            <form
                @submit.prevent="submitSignUp"
                class="w-4/12 h-fit border-2 border-slate-400 rounded-lg gap-4 flex flex-col justify-center items-center py-6 px-6 bg-slate-700"
            >
                <p class="text-xl font-bold text-white">Sign Up</p>
                <input
                    v-model="signUp.name"
                    type="text"
                    required
                    placeholder="Name"
                    class="w-full border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2 placeholder:text-blue-950 font-semibold outline-none"
                />
                <input
                    v-model="signUp.email"
                    type="email"
                    required
                    placeholder="Email"
                    class="w-full border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2 placeholder:text-blue-950 font-semibold outline-none"
                />
                <input
                    v-model="signUp.password"
                    type="password"
                    required
                    placeholder="Password"
                    class="w-full border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2 placeholder:text-blue-950 font-semibold outline-none"
                />
                <input
                    v-model="signUp.password_confirmation"
                    type="password"
                    required
                    placeholder="Confirm Password"
                    class="w-full border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2 placeholder:text-blue-950 font-semibold outline-none"
                />
                <button
                    type="submit"
                    class="border-2 border-green-400 bg-green-300 py-1 px-4 text-green-950 rounded-md font-medium text-lg"
                >
                    Sign Up
                </button>
            </form>
        </div>
    </nav>
</template>

<script>
import axios from "../axios"; // Ensure you have this import to use axios

export default {
    isDarkMode: false,
    name: "Sidebar",
    data() {
        return {
            showProfileOptions: false,
            showSignInForm: false,
            showSignUpForm: false,
            signIn: {
                email: "",
                password: "",
            },
            signUp: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
        };
    },
    methods: {
        toggleTheme() {
            this.isDarkMode = !this.isDarkMode;
            document.documentElement.classList.toggle("dark", this.isDarkMode);
            localStorage.setItem("theme", this.isDarkMode ? "dark" : "light");
        },
        loadTheme() {
            const savedTheme = localStorage.getItem("theme");
            this.isDarkMode = savedTheme === "dark";
            document.documentElement.classList.toggle("dark", this.isDarkMode);
        },
        toggleProfileOptions() {
            this.showProfileOptions = !this.showProfileOptions;
        },
        async submitSignIn() {
            try {
                const response = await axios.post("/login", this.signIn);
                if (response.data.token) {
                    localStorage.setItem("token", response.data.token);
                    axios.defaults.headers.common[
                        "Authorization"
                    ] = `Bearer ${response.data.token}`;
                }
                this.$emit("user-logged-in", response.data.user);
                this.showSignInForm = false;
            } catch (error) {
                console.error(
                    "Error signing in:",
                    error.response?.data || error.message
                );
                alert("Error signing in. Please try again.");
            }
        },
        async submitSignUp() {
            try {
                const response = await axios.post("/store", this.signUp);
                alert("Sign up successful!");
                this.showSignUpForm = false;
                // Handle successful sign-up (e.g., update UI, store token, etc.)
            } catch (error) {
                console.error(
                    "Error signing up:",
                    error.response?.data || error.message
                );
                alert("Error signing up. Please try again.");
            }
        },
        mounted() {
            this.loadTheme();
        },
    },
};
</script>

<style scoped>
#themeButton {
    background: #000;
}
</style>
