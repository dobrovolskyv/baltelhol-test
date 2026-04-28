<template>
    <section class="bg-white w-full">
        <header class="p-4 flex justify-between bg-teal-200">
            <h1>HOME PAGE</h1>
            <div class="flex items-center gap-3 ">
                <Link :href="route('admin.products.index')" class="hover:hover:text-cyan-600">Админ панель</Link>

                <div v-if="token">
                    <button @click="logout" class="hover:hover:text-cyan-600">Выход</button>
                </div>

                <!--                <div v-else>-->
                <!--                    <Link :href="route('login')" class="hover:hover:text-cyan-600">Вход</Link>-->
                <!--                </div>-->

            </div>
        </header>
    </section>
    <section class="w-full">
        <div class="flex items-start justify-center">
            <div class="w-3/4 bg-gray-50 p-4 h-full">
                <article>
                    <slot/>
                </article>
            </div>
        </div>
    </section>
</template>

<script setup>
import {Link, router} from "@inertiajs/vue3";
import {useAuth} from "@/feature/useAuth.js";
import {onMounted} from "vue";
import axios from "axios";


const {token,clearToken, checkAndRedirect} = useAuth();

onMounted(() => {
    checkAndRedirect()
})


const logout = async () => {
    try {
        await axios.post('/logout');
        localStorage.removeItem('admin_token');
        delete axios.defaults.headers.common['Authorization']
        router.visit(route('home'));
    } catch (e) {
        console.error(e)
    }
}


</script>


<style scoped></style>
