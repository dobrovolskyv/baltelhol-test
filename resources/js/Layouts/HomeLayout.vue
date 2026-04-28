<template>
    <div class="min-h-screen bg-gray-50 font-sans text-gray-900">
        <!-- Навигационная панель -->
        <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <Link :href="route('home')" class="text-2xl font-bold text-indigo-600 tracking-tight">
                                BalTelHol
                            </Link>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <Link :href="route('admin.products.index')" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">
                            Панель управления
                        </Link>

                        <button v-if="isAuthenticated" @click="logout" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Выйти
                        </button>
                        <Link v-else :href="route('login')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Войти
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Основной контент -->
        <main class="w-full">
            <slot/>
        </main>


    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import axios from "axios";

const isAuthenticated = ref(false);

onMounted(() => {
    isAuthenticated.value = !!localStorage.getItem('admin_token');
});

const logout = () => {
    router.post(route('logout'), {}, {
        onSuccess: () => {
            localStorage.removeItem('admin_token');
            delete axios.defaults.headers.common['Authorization'];
            isAuthenticated.value = false;
        }
    });
};
</script>

<style scoped></style>
