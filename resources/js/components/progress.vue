<template>
    <section
        id="todo"
        class="border-2 border-blue-300 flex flex-col justify-center items-center w-6/5 h-auto overflow-y-auto py-4 rounded-md bg-blue-500/25"
    >
        <div class="w-full">
            <h1
                class="ml-8 my-2 text-2xl font-bold text-blue-950 dark:text-blue-400"
            >
                In Progress
            </h1>
        </div>

        <div
            id="task pendingTask"
            class="border-2 border-slate-400 bg-zinc-50 flex flex-col justify-center items-center w-11/12 py-2 px-2 rounded-md"
        >
            <div
                class="w-full h-fit text-md font-semibold flex justify-start items-center"
            >
                <h3 class="text-lg w-1/2 text-left">go to School</h3>

                <div class="flex justify-end items-center w-1/2 pr-4 gap-4">
                    <a
                        href="#"
                        @click.prevent="toggleOptions"
                        class="text-md text-lg text-zinc-500 relative"
                    >
                        &#x260D;
                        <options
                            v-if="showOptions"
                            class="absolute top-full right-2"
                        />
                    </a>
                    <a href="#" class="text-md text-lg text-red-800"
                        >&#x2715;</a
                    >
                </div>
            </div>

            <div class="w-fit h-fit py-1">
                <p class="text-md font-medium text-zinc-500">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Itaque inventore eligendi, ad rerum incidunt dolores, est
                    iure, repudiandae iusto aliquam molestiae id odit sit iste
                    vero velit sapiente doloribus eos?
                </p>
            </div>
        </div>
    </section>
</template>

<script>
import options from "./options.vue";
export default {
    components: { options },
    name: "progress",
    data() {
        return {
            showOptions: false,
        };
    },
    methods: {
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
        closeOptions(event) {
            if (!event.target.closest(".relative")) {
                this.showOptions = false;
            }
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
