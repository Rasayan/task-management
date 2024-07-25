

<template>
    <div class="w-full h-screen py-5 px-9 flex flex-col justify-start items-start">

        <TaskPageNav />

        <div class="w-full h-auto flex justify-around items-start my-4">
            <ToDo/>
            <Progress />
            <Done/>
        </div>
    </div>
</template>

<script>
import TaskPageNav from "./components/taskPageNav.vue";
import ToDo from "./components/toDo.vue";
import Progress from "./components/progress.vue";
import Done from "./components/done.vue";
    export default {
    name: "App",
    components: { TaskPageNav, ToDo, Progress, Done }
}
</script>

