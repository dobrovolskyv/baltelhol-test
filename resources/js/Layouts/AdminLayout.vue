<template>
    <div class="flex h-screen bg-gray-100 font-sans">
        <!-- Sidebar (Сайдбар в стиле Atlantis) -->
        <aside class="w-64 bg-[#1e1e2d] text-gray-300 flex-shrink-0 flex flex-col transition-all duration-300 z-20 shadow-xl">
            <!-- Логотип -->
            <div class="h-16 flex items-center px-6 bg-[#1a1a27] border-b border-gray-800">
                <Link :href="route('home')" class="flex items-center gap-3 w-full">
                    <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-500/30">
                        B
                    </div>
                    <span class="text-white text-lg font-bold tracking-wider">BalTelHol</span>
                </Link>
            </div>

            <!-- Навигация -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 px-2">Управление</div>

                <Link :href="route('admin.products.index')"
                      class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group"
                      :class="route().current('admin.products.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'hover:bg-[#2b2b40] hover:text-white'">
                    <svg class="w-5 h-5 mr-3" :class="route().current('admin.products.*') ? 'text-white' : 'text-gray-400 group-hover:text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="font-medium">Товары</span>
                </Link>
            </nav>

            <!-- Пользователь / Выход -->
            <div class="p-4 border-t border-gray-800 bg-[#1a1a27]">
                <button @click="logout" class="flex items-center w-full px-4 py-3 text-sm font-medium rounded-xl text-gray-400 hover:text-white hover:bg-[#2b2b40] transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Выйти
                </button>
            </div>
        </aside>

        <!-- Главная область контента -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            <!-- Верхняя панель -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8 z-10">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-gray-800">
                        Панель администратора
                    </h2>
                </div>
                <div class="flex items-center gap-4">
                    <Link :href="route('home')" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Перейти на главную страницу
                    </Link>
                </div>
            </header>

            <!-- Основной контент страницы -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#f3f4f6]">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import axios from "axios";

const logout = () => {
    router.post(route('logout'), {}, {
        onSuccess: () => {
            localStorage.removeItem('admin_token');
            delete axios.defaults.headers.common['Authorization'];
        }
    });
};
</script>

<style scoped>

::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
::-webkit-scrollbar-track {
    background: transparent;
}
::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
