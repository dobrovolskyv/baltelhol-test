<template>
    <div>
        <h1 class="text-2xl font-bold">EDIT PRODUCT</h1>
        <div v-if="product">

            <p>Name: {{ product.name }}</p>
            <p>Description: {{ product.description }}</p>
            <p>Price: {{ product.price }}</p>

        </div>

        <Link class="block hover:text-blue-900 text-blue-400 mt-[40px]" :href="route('admin.product.index')">Назад в админку</Link>
    </div>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3'

defineOptions({
    layout: AdminLayout
})

const props = defineProps({
    product: { type: Object, required: true }
})

</script>

<style></style>