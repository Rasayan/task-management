<template>
    <div class="w-full h-fit flex justify-between items-center">
        <!-- Show user name if logged in -->
        <div v-if="user" class="text-blake text-2xl font-bold">
            Welcome, {{ user.name }}
        </div>

        <div v-if="!user" class="text-blake text-2xl font-medium">
            Please Sign-In to view your tasks!
        </div>

        <!-- New Task Button -->
        <div class="flex justify-center items-center w-fit h-fit gap-4">
            <button
                @click="$emit('toggleForm')"
                class="border-2 border-blue-700 bg-blue-500 rounded-md py-1 px-6 text-zinc-50 font-extrabold"
            >
                New Task
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "TaskPageNav",
    props: ["user"],
};
</script>
