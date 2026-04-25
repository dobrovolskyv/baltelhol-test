<template>
    <div>
        <h1>CREATE PRODUCT</h1>
        <SuccessPopup 
            :show="showSuccess" 
            message="Продукт успешно создан!"
            @close="showSuccess = false"
        />
        <div class="flex flex-col items-start gap-5">
            <input v-model="form.name" class="border border-gray-400 rounded max-w-80 w-full" type="text" required
                placeholder="name">
            <textarea v-model="form.description" class="border border-gray-400 rounded max-w-80 w-full resize-none"
                placeholder="description"></textarea>
            <select v-model="form.category_id" class="border border-gray-400 rounded max-w-80 w-full" required>
                <option value="" disabled>Выберите категорию</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                </option>
            </select>
            <input v-model.number="form.price" class="border border-gray-400 rounded max-w-80 w-full" type="number"
                placeholder="price">
        </div>

        <button @click="storeProduct"
            class="inline-block px-3 py-2 bg-blue-700 border border-blue-500 text-white text-xs rounded mt-5">
            Создать
        </button>

        <Link class="block text-blue-400 hover:text-blue-900 mt-5" :href="route('admin.product.index')">
            Назад в админку
        </Link>
    </div>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import axios from 'axios';
import { reactive, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3'
import SuccessPopup from '@/Components/SuccessPopup.vue'

defineOptions({
    layout: AdminLayout
})

const props = defineProps({
    product: { type: Object, required: true },
    categories: { type: Object, required: true }
})

const form = reactive({
    name: '',
    description: '',
    price: '',
    category_id: ''
})

const errors = ref({})
const showSuccess = ref(false)

const storeProduct = () => {
    router.post(route('admin.product.store'), form, {
        onSuccess: () => {
            form.name = ''
            form.description = ''
            form.price = null
            form.category_id= ''
            errors.value = {}
            
            showSuccess.value = true
            

            setTimeout(() => {
                showSuccess.value = false
            }, 3000)
        },
        onError: (err) => {
            errors.value = err
            console.log('Ошибки валидации:', err)
        }
    })
}
</script>

<style lang="scss" scoped></style>