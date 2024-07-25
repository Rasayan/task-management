<style scoped>
select {
  width: auto;
  transition: width 0.2s ease;
}
</style>

<template>
    <div class="w-full h-fit flex justify-between items-center">

        <div>
            <select
            v-model="selectedMonth"
            class="appearance-none bg-transparent rounded-md py-2 pl-3 font-normal
             leading-tight focus:outline-none text-4xl text-zinc-950"
            ref="monthSelect"
            >
                <option value="" disabled selected>Month</option>
                <option v-for="month in months" :key="month" :value="month">
                    {{ month }}
                </option>
            </select>
            <select v-model="selectedDay" 
            class="appearance-none bg-transparent rounded-md py-2 px-3 mr-2 leading-tight text-4xl 
            focus:outline-none text-zinc-400 font-normal">
                <option value="" disabled selected>Day</option>
                <option v-for="day in days" :key="day" :value="day">
                    {{ day }}
                </option>
            </select>
        </div>

        <div class="flex justify-center items-center w-fit h-fit gap-4">
          <Week :selectedMonth="selectedMonth" :selectedDay="selectedDay"/>

          <a href="#" 
            class="border-2 border-blue-700 bg-blue-500 rounded-md py-1 px-6 text-zinc-50 font-extrabold">
            New Task
          </a>
        </div>

    </div>
</template>

<script>
import Week from "./week.vue";
    export default {
        name: 'TaskHead',
        components: {
    Week
},
        data() {
    return {
      months: [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
      ],
      days: Array.from({ length: 31 }, (_, i) => i + 1),
      selectedMonth: '',
      selectedDay: ''
    }
  },
  watch: {
    selectedMonth() {
      this.$nextTick(this.adjustMonthSelectWidth);
    }
  },
  mounted() {
    this.adjustMonthSelectWidth();
  },
  methods: {
    adjustMonthSelectWidth() {
      const select = this.$refs.monthSelect;
      const option = select.options[select.selectedIndex];
      const canvas = document.createElement('canvas');
      const context = canvas.getContext('2d');
      context.font = window.getComputedStyle(select).font;
      const width = context.measureText(option.textContent).width;
      select.style.width = `${width + 40}px`; // Add some padding
    }
  }
    }
</script>