<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

onMounted(() => {
    const token = localStorage.getItem('admin_token');
    if (!token) router.visit('/login');
    else axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
});


</script>

<template>
    <h2>admi </h2>
</template>

<style scoped lang="scss">

</style>
