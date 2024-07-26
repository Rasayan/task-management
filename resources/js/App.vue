<template>
    <Sidebar />
    <div
        class="w-10/12 h-screen py-5 px-9 flex flex-col justify-start items-start relative"
    >
        <TaskPageNav />

        <div class="w-full h-auto flex justify-around items-start my-4">
            <ToDo />
            <Progress />
            <Done />
        </div>

        <div
        class="w-full h-screen py-5 px-9 flex justify-center items-center absolute top-0 left-0 bg-blue-500/15 backdrop-blur-md"
    >
        <form
            class="w-4/12 h-fit border-2 border-slate-400 rounded-lg gap-4
            flex flex-col justify-center items-center py-6 px-6 bg-slate-700"
        >
            <p class="text-xl font-bold text-white">Add new task!</p>
            <input type="text" required placeholder="Heading" 
            class="w-full h-1/5 border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2
                placeholder:text-blue-950 font-semibold outline-none">
            <input type="text" required placeholder="Description" 
            class="w-full h-2/5 border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2
                placeholder:text-blue-950 font-semibold outline-none">

            <button class="border-2 border-green-400 bg-green-300 py-1 px-4 text-green-950 rounded-md font-medium text-lg">submit!</button>
    </form>
    </div>
    </div>
</template>

<script>
import Sidebar from "./components/sidebar.vue";
import TaskPageNav from "./components/taskPageNav.vue";
import ToDo from "./components/toDo.vue";
import Progress from "./components/progress.vue";
import Done from "./components/done.vue";
export default {
    name: "App",
    components: { TaskPageNav, ToDo, Progress, Done, Sidebar },
};
</script>
