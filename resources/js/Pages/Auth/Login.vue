<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Панель администратора
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Войдите, чтобы управлять каталогом
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-gray-100">
                <form class="space-y-6" @submit.prevent="submit">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required v-model="form.email"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Пароль
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password" required v-model="form.password"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                    </div>

                    <div>
                        <button type="submit" :disabled="loading"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            {{ loading ? 'Вход...' : 'Войти' }}
                        </button>
                    </div>
                </form>

                <div v-if="error" class="mt-4 rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                {{ error }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const form = ref({ email: '', password: '' });
const error = ref('');
const loading = ref(false);

const submit = async () => {
    loading.value = true;
    error.value = '';
    try {
        const response = await axios.post('/api/login', form.value);
        const token = response.data.token;
        localStorage.setItem('admin_token', token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

        router.get(route('admin.products.index'));
    } catch (err) {
        if (err.response && err.response.data.errors) {
            error.value = Object.values(err.response.data.errors).flat().join(', ');
        } else {
            error.value = 'Неверные учетные данные';
        }
    } finally {
        loading.value = false;
    }
};
</script>

<style scoped></style>
