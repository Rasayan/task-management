<template>
    <form @submit.prevent="submitForm2" class="w-4/12 h-fit border-2 border-slate-400 rounded-lg gap-4 flex flex-col justify-center items-center py-6 px-6 bg-slate-700">
        <p class="text-xl font-bold text-white">My Profile</p>
        <input v-model="user.name" type="text" required placeholder="Name" 
               class="w-full h-1/5 border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2
               placeholder:text-blue-950 font-semibold outline-none">
        <input v-model="user.email" type="email" required placeholder="Email" 
               class="w-full h-1/5 border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2
               placeholder:text-blue-950 font-semibold outline-none">
        <input v-model="user.password" type="password" required placeholder="Password" 
               class="w-full h-1/5 border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2
               placeholder:text-blue-950 font-semibold outline-none">
        <input v-model="user.password_confirmation" type="password" required placeholder="Confirm Password" 
               class="w-full h-1/5 border-2 border-blue-300 rounded-md bg-slate-100 py-1 px-2
               placeholder:text-blue-950 font-semibold outline-none">
        <button type="submit" 
                class="border-2 border-green-400 bg-green-300 py-1 px-4 text-green-950 rounded-md font-medium text-lg">
            Submit!
        </button>
    </form>
</template>

<script>
import axios from '../axios';

export default {
    name: 'createUser',
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        }
    },
    methods: {
        async submitForm2() {
            try {
                await axios.post('/user/store', this.user);
                alert('User created successfully!');
                this.resetForm();
            } catch (error) {
                console.error('Error creating user:', error.response?.data || error.message);
                alert('Error creating user. Please try again.');
            }
        },
        resetForm() {
            this.user = {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            };
        }
    }
}
</script>
