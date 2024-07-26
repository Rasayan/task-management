<template>
    <nav class="w-2/12 h-screen bg-transparents block relative left-1 top-0 py-2 px-2">
        <div
            class="w-full h-full py-2 px-2 bg-zinc-50 flex border-2 border-slate-500
            flex-col justify-between items-center rounded-lg z-100"
        >
            <div class="w-full h-fit flex justify-center items-center">
                <h1 class="text-blue-900 text-4xl font-bold">Traction</h1>
            </div>

            <div class="flex flex-col justify-center items-center gap-3 w-full h-fit">
                <a href="#" 
                    class="w-full h-fit text-center text-blue-600 text-xl duration-200 py-2
                    font-medium hover:bg-blue-500 hover:text-white rounded-md"
                >
                    Bookmarks
                </a>
                <a href="#" 
                    class="w-full h-fit text-center text-blue-600 text-xl duration-200 py-2
                    font-medium hover:bg-blue-500 hover:text-white rounded-md"
                >
                    Profile
                </a>
            </div>

            <div class="flex flex-col justify-center items-center gap-3 w-full h-fit py-3">
                <a href="#" 
                    class="text-slate-100 text-lg font-semibold w-full h-fit text-center bg-slate-900 py-2 rounded-lg"
                >
                    Settings
                </a>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Sidebar",
};
</script>
