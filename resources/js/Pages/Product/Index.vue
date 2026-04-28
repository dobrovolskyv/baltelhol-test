<template>
    <div>
        <h1 class="text-3xl text-black font-bold uppercase text-center">Главная старница</h1>
        <div v-if="token" >
            <h2>token</h2>
        </div>

        <h2 class="text-3xl text-green-700 border border-teal-700 py-2 px-4 inline-block"> FILTER</h2>
        <div class=" p-4">
            <div class="p-2 flex items-center justify-between font-bold">
                <p>Name</p>

            </div>
            <div v-for="product in products.data" :key="product.id"
                 class="font-bold p-2 flex items-center justify-between text-3xl uppercase text-cyan-900">
<!--                    <p>{{product.name}}</p>-->
                <Link :href="route('product.show', product.id)" class="hover:text-cyan-600">{{ product.name }}</Link>

            </div>
        </div>
        <div class="mt-5 flex justify-center flex-wrap gap-2">
            <!-- <Link
            v-if="products.links?.prev"
            :href="products.links.prev"
            class="px-3 py-1 border rounded">
            назад
            </Link>
            <span v-else class="px-3 py-1 border rounded opacity-50 cursor-not-allowed">назад2</span> -->

            <div v-for="(link, i) in products.meta.links" :key="i">
                <Link
                    v-if="link.url"
                    :href="link.url"
                    class="px-3 py-1 border rounded"
                    :class="{ 'bg-blue-500 text-white': link.active }">
                    <span v-html="link.label"></span>
                </Link>
                <span
                    v-else
                    class="px-3 py-1 border rounded opacity-50 cursor-not-allowed"
                    v-html="link.label"
                ></span>
            </div>
            <!--
                        <Link v-if="products.links?.next"
                        :href="products.links.next"
                        class="px-3 py-1 border rounded">
                        >
                          вперед
                        </Link>
                        <span v-else class="px-3 py-1 border rounded opacity-50 cursor-not-allowed">вперед2</span> -->
        </div>

    </div>
</template>

<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import {Link, router} from '@inertiajs/vue3'
import {onMounted,ref} from "vue";
import axios from "axios";
import {useAuth} from "@/feature/useAuth.js";


defineOptions({
    layout: HomeLayout
})
const props = defineProps({
    products: { type: Object, required: true }
})
const { token, checkAndRedirect } = useAuth();

onMounted(()=>{
    checkAndRedirect();
})
// const token = ref(localStorage.getItem('admin_token'));
//
// onMounted(() => {
//     if (!token.value) {
//         router.visit('/login');
//     } else {
//         axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`;
//     }
// });
</script>

<style lang="scss" scoped></style>
