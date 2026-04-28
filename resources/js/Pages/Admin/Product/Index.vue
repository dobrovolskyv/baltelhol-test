<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Управление товарами</h1>
            <div class="mt-4 sm:mt-0">
                <Link :href="route('admin.products.create')"
                      class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Добавить товар
                </Link>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Товар
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Категория
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Цена
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Действия</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="product in products.data" :key="product.id" class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ product.name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ product.category?.name || 'Без категории' }}
                                        </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ product.price }} ₽
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link :href="route('admin.products.edit', product.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">Редактировать</Link>
                                    <button @click.prevent="deleteProduct(product.id)" class="text-red-600 hover:text-red-900">Удалить</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-center flex-wrap gap-2">
            <div v-for="(link, i) in products.meta.links" :key="i">
                <Link v-if="link.url" :href="link.url" class="px-4 py-2 border rounded-md text-sm font-medium"
                      :class="{ 'bg-indigo-600 text-white border-indigo-600': link.active, 'bg-white text-gray-700 hover:bg-gray-50': !link.active }">
                    <span v-html="link.label"></span>
                </Link>
                <span v-else class="px-4 py-2 border rounded-md text-sm font-medium opacity-50 cursor-not-allowed bg-gray-50 text-gray-500" v-html="link.label"></span>
            </div>
        </div>
    </div>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3'

defineOptions({
    layout: AdminLayout
})

const props = defineProps({
    products: { type: Object, required: true }
})

const deleteProduct = (id) => {
    if (confirm('Вы уверены, что хотите удалить этот товар?')) {
        router.delete(route('admin.products.destroy', id), {
            preserveScroll: true,
        })
    }
}
</script>

<style scoped></style>
