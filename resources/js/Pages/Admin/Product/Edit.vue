<template>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Редактировать товар</h1>
        </div>

        <SuccessPopup
            :show="showSuccess"
            message="Продукт успешно обновлен!"
            @close="showSuccess = false"
        />

        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Информация о товаре</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Обновите информацию о существующем товаре.
                    </p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="updateProduct" v-if="product">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                                <input type="text" id="name" v-model="form.name" required
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3 border"
                                       :class="{'border-red-300': errors.name}"
                                       placeholder="Название товара">
                                <p v-if="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name }}</p>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Категория</label>
                                <select id="category_id" v-model="form.category_id" required
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        :class="{'border-red-300': errors.category_id}">
                                    <option value="" disabled>Выберите категорию</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <p v-if="errors.category_id" class="mt-2 text-sm text-red-600">{{ errors.category_id }}</p>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="price" class="block text-sm font-medium text-gray-700">Цена (₽)</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number" id="price" v-model.number="form.price" step="0.01" min="0.01" required
                                           class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border"
                                           :class="{'border-red-300': errors.price}"
                                           placeholder="0.00">
                                </div>
                                <p v-if="errors.price" class="mt-2 text-sm text-red-600">{{ errors.price }}</p>
                            </div>

                            <div class="col-span-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                                <div class="mt-1">
                                    <textarea id="description" v-model="form.description" rows="3"
                                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md py-2 px-3"
                                              :class="{'border-red-300': errors.description}"
                                              placeholder="Краткое описание товара..."></textarea>
                                </div>
                                <p v-if="errors.description" class="mt-2 text-sm text-red-600">{{ errors.description }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4 border-t border-gray-200 pt-5">
                            <Link :href="route('admin.products.index')" class="text-sm font-medium text-gray-700 hover:text-gray-900">
                                Отмена
                            </Link>
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { reactive, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3'
import SuccessPopup from '@/Components/SuccessPopup.vue'

defineOptions({
    layout: AdminLayout
})

const props = defineProps({
    product: { type: Object, required: true },
    categories: { type: Array, required: true }
})

const form = reactive({
    name: props.product.name,
    description: props.product.description,
    price: props.product.price,
    category_id: props.product.category_id
})

const errors = ref({})
const showSuccess = ref(false)

const updateProduct = () => {
    router.put(route('admin.products.update', props.product.id), form, {
        onSuccess: () => {
            errors.value = {}
            showSuccess.value = true
            setTimeout(() => {
                showSuccess.value = false
            }, 3000)
        },
        onError: (err) => {
            errors.value = err
        }
    })
}
</script>

<style scoped></style>
