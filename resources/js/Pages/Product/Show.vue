<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <Link :href="route('home')" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад к каталогу
            </Link>
        </div>

        <div v-if="product" class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl  leading-6 font-extrabold text-gray-900">
                        {{ product.name }}
                    </h3>
                    <p class="mt-2 max-w-2xl text-sm text-gray-500">
                        Подробная информация о товаре
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                        {{ product.category?.data?.name || product.category?.name || 'Без категории' }}
                    </span>
                </div>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Название
                        </dt>
                        <dd class="mt-1 text-md text-gray-900 sm:mt-0 sm:col-span-2 font-bold uppercase">
                            {{ product.name }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Цена
                        </dt>
                        <dd class="mt-1 text-lg font-bold text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ product.price }} ₽
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Категория
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{product.category?.data?.name || product.category?.name || 'Нет' }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Описание
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-wrap">
                            {{ product.description || 'Описание отсутствует.' }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</template>

<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Link } from '@inertiajs/vue3'

defineOptions({
    layout: HomeLayout
})

const props = defineProps({
    product: { type: Object, required: true },
})

console.log('Product:', props.product);
console.log('Product category:', props.product.category);
console.log('Categories list:', props.categories);
</script>

<style scoped></style>
