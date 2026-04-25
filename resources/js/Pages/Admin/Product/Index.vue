<template>
    <div>
        <h1 class="font-bold text-3xl">Управление товарами</h1>
        <div class="">
            <div class="py-2 flex items-center justify-between font-bold">
                <p>Name</p>
                <Link :href="route('admin.product.create')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 font-bold text-blue-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                </Link>
            </div>
            <div v-for="product in products.data" :key="product.id"
                class="font-bold py-2 flex items-center justify-between text-3xl uppercase text-cyan-900">
                {{ product.name }}
                <div class="flex items-center gap-2">
                    <Link :href="route('admin.product.edit', product.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                    </Link>

                    <button @click.prevent="destroyProduct(product.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>

                <!-- <Link :href="route('product.show', product.id)" class="hover:text-cyan-600">{{ product.name }}</Link> -->

            </div>
        </div>
        <div class="mt-5 flex justify-center flex-wrap gap-2">
            <div v-for="(link, i) in products.meta.links" :key="i">
                <Link v-if="link.url" :href="link.url" class="px-3 py-1 border rounded"
                    :class="{ 'bg-blue-500 text-white': link.active }">
                    <span v-html="link.label"></span>
                </Link>
                <span v-else class="px-3 py-1 border rounded opacity-50 cursor-not-allowed" v-html="link.label"></span>
            </div>
        </div>

    </div>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

import { Link,router } from '@inertiajs/vue3'
import axios from 'axios';

defineOptions({
    layout: AdminLayout
})
const props = defineProps({
    products: { type: Array, required: true }
})

const destroyProduct = (id) => {
    router.delete(route('admin.product.destroy', id), {
        preserveScroll: true,
        onSuccess: () => {

            // console.log('Продукт удален')
        },
        onError: (errors) => {
            // console.error('Ошибка при удалении:', errors)
        }
    })
}
</script>

<style lang="scss" scoped></style>