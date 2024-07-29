<template>
    <div
        class="options-component w-32 border-2 border-slate-500 bg-zinc-100 flex flex-col justify-center items-center rounded-md py-2 px-2 z-50"
    >
        <a
            href="#"
            @click.stop.prevent="$emit('edit-task')"
            class="text-sm text-zinc-900 font-medium border-b-2 border-zinc-400 w-full text-center mb-2"
        >
            Edit
        </a>
        <a
            href="#"
            @click.stop.prevent="togglePromoteOptions"
            class="text-sm text-zinc-900 font-medium w-full text-center"
        >
            Promote
        </a>
        <div
            v-if="showPromoteOptions"
            class="mt-2 w-full flex flex-col items-center"
        >
            <button
                @click.stop="changeStatus('pending')"
                class="w-full text-sm mb-1"
            >
                Pending
            </button>
            <button
                @click.stop="changeStatus('in_progress')"
                class="w-full text-sm mb-1"
            >
                In Progress
            </button>
            <button
                @click.stop="changeStatus('completed')"
                class="w-full text-sm"
            >
                Completed
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Options",
    props: ["taskId"],
    data() {
        return {
            showPromoteOptions: false,
        };
    },
    methods: {
        togglePromoteOptions() {
            this.showPromoteOptions = !this.showPromoteOptions;
            console.log("showPromoteOptions:", this.showPromoteOptions);
        },
        changeStatus(status) {
            this.$emit("change-status", {
                taskId: this.taskId,
                newStatus: status,
            });
            this.showPromoteOptions = false;
        },
    },
};
</script>

<style scoped>
.options-component {
    min-width: 120px;
}
button,
a {
    padding: 4px 8px;
    transition: background-color 0.3s;
}
button:hover,
a:hover {
    background-color: #e5e7eb;
}
</style>
