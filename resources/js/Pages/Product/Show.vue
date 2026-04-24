<template>
    <div class="h-full">
        <h1>PRODUCT ID PAGE</h1>
        <!-- <pre>{{ JSON.stringify(product, null, 2) }}</pre> -->
        <!-- Отображаем данные продукта -->
        <div v-if="product" class="p-4 flex items-center justify-between">
            <h2 class="text-2xl font-bold">{{ product.name }}</h2>
            <p class="text-gray-600">{{ product.description }}</p>
            <p class="text-lg font-semibold">Цена: {{ product.price }} руб.</p>
            <p v-if="product.category" class="text-sm text-gray-500">
                Категория: {{ product.category.name }}
            </p>
        </div>

        <!-- Ссылка назад -->
        <Link :href="route('home')" class="hover:text-blue-900 text-blue-400 mt-auto block">
            ← Назад к списку продуктов
        </Link>

    </div>
</template>

<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Link } from '@inertiajs/vue3'

defineOptions({
    layout: HomeLayout
})
const props = defineProps({
    product: { type: Object, required: true }
})
</script>

<style lang="scss" scoped></style>
