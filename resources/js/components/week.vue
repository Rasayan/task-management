<template>
    <div class="bg-gray-100 rounded-md p-2 text-md font-normal tracking-wide text-zinc-600 px-6">
      Week {{ weekOfYear }}
    </div>
  </template>
  
  <script>
  export default {
    name: 'WeekOfYear',
    props: {
      selectedMonth: {
        type: String,
        required: true
      },
      selectedDay: {
        type: [Number, String],
        required: true
      }
    },
    computed: {
      weekOfYear() {
        if (!this.selectedMonth || !this.selectedDay) {
          return '-';
        }
  
        const currentYear = new Date().getFullYear();
        const date = new Date(`${this.selectedMonth} ${this.selectedDay}, ${currentYear}`);
        
        // Adjust date to Thursday of the current week
        date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
        
        // Get the first Thursday of the year
        const week1 = new Date(date.getFullYear(), 0, 4);
        
        // Calculate full weeks to nearest Thursday
        return 1 + Math.round(((date.getTime() - week1.getTime()) / 86400000 - 3 + (week1.getDay() + 6) % 7) / 7);
      }
    }
  }
  </script>