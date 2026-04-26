<template>
    <div>
        <h2>Admin Login</h2>
        <form @submit.prevent="submit">
            <input type="email" v-model="form.email" placeholder="Email"/>
            <input type="password" v-model="form.password" placeholder="Password"/>
            <button type="submit">Login</button>
        </form>
        <div v-if="error">{{ error }}</div>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import {router} from '@inertiajs/vue3';
import axios from 'axios';

const form = ref({email: '', password: ''});
const error = ref('');

const submit = async () => {
    try {
        const response = await axios.post('/api/login', form.value);
        const token = response.data.token;
        localStorage.setItem('admin_token', token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        // Перенаправляем в админ‑панель
        // router.get('admin.products.index');
        // router.visit('/')
        router.get(route('admin.products.index'));
    } catch (err) {
        error.value = 'Invalid credentials';
    }
};
</script>
