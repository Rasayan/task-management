<template>
    <div
        class="w-10/12 h-screen py-5 px-9 flex justify-center items-center absolute top-0 left-0 bg-blue-500/15 backdrop-blur-md"
    >
        <div class="w-4/12 h-fit border-2 border-blue-400 rounded-md flex flex-col justify-center items-center">
            <input type="text" required placeholder="Heading" class="w-full h-1/5 border-2 border-blue-950 rounded-md">
            <input type="text" required placeholder="Description" class="w-full h-1/5 border-2 border-blue-950 rounded-md">
        </div>
    </div>
</template>

<script>
    export default {
        name: "newTask",
    };
</script>