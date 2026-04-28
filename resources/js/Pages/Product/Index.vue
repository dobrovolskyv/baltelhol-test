<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-4xl text-gray-900 font-extrabold tracking-tight mb-8">Каталог товаров</h1>

        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <label for="category" class="text-sm font-medium text-gray-700">Фильтр по категории:</label>
                <select
                    id="category"
                    v-model="selectedCategory"
                    @change="filterProducts"
                    class="mt-1 block w-64 rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm shadow-sm"
                >
                    <option value="">Все категории</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-md mb-8">
            <ul role="list" class="divide-y divide-gray-200">
                <li v-for="product in products.data" :key="product.id">
                    <Link :href="route('product.show', product.id)" class="block hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-lg font-bold text-indigo-600 truncate">{{ product.name }}</p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ product.price }} ₽
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex">
                                    <p class="flex items-center text-sm text-gray-500">
                                        {{ product.category?.name }}
                                    </p>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                    <p class="truncate max-w-xs">{{ product.description }}</p>
                                </div>
                            </div>
                        </div>
                    </Link>
                </li>
            </ul>
        </div>

        <div class="mt-5 flex justify-center flex-wrap gap-2">
            <div v-for="(link, i) in products.meta.links" :key="i">
                <Link
                    v-if="link.url"
                    :href="link.url"
                    class="px-4 py-2 border rounded-md text-sm font-medium"
                    :class="{ 'bg-indigo-600 text-white border-indigo-600': link.active, 'bg-white text-gray-700 hover:bg-gray-50': !link.active }">
                    <span v-html="link.label"></span>
                </Link>
                <span
                    v-else
                    class="px-4 py-2 border rounded-md text-sm font-medium opacity-50 cursor-not-allowed bg-gray-50 text-gray-500"
                    v-html="link.label"
                ></span>
            </div>
        </div>
    </div>
</template>

<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Link, router } from '@inertiajs/vue3'
import { ref } from "vue";

defineOptions({
    layout: HomeLayout
})

const props = defineProps({
    products: { type: Object, required: true },
    categories: { type: Array, required: true },
    filters: { type: Object, default: () => ({}) }
})

const selectedCategory = ref(props.filters.category_id || '')

const filterProducts = () => {
    router.get(route('home'), { category_id: selectedCategory.value }, {
        preserveState: true,
        replace: true
    })
}
</script>

<style scoped></style>
