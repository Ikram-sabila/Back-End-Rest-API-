<template>
    <div class="container">
        <h2>Tambah Item</h2>
        <form @submit.prevent="submitForm">
            <div>
                <label>Nama:</label>
                <input v-model="form.nama" required />
            </div>
            <div>
                <label>Jumlah:</label>
                <input v-model.number="form.jumlah" type="number" required />
            </div>
            <div>
                <label>Harga:</label>
                <input v-model.number="form.harga" type="number" step="0.01" required />
            </div>
            <div>
                <label>Gambar URL:</label>
                <input v-model="form.gambar_url" type="text" />
            </div>
            <div>
                <label>Kategori:</label>
                <select v-model="form.category_id">
                    <option value="">-- Pilih Kategori --</option>
                    <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                        {{ cat.nama }}
                    </option>
                </select>
            </div>
            <button type="submit">Tambah</button>
        </form>

        <h2>Daftar Item</h2>
        <div v-if="items.length === 0">Belum ada item.</div>
        <ul>
            <li v-for="item in items" :key="item.id">
                <strong>{{ item.nama }}</strong> - {{ item.jumlah }} pcs - Rp {{ item.harga }}
                <div v-if="item.category">{{ item.category.nama }}</div>
                <div v-if="item.gambar_url" class="image-container">
                    <img :src="item.gambar_url" alt="Gambar" />
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const items = ref([])
const categories = ref([])

const form = ref({
    nama: '',
    jumlah: 1,
    harga: 0,
    gambar_url: '',
    category_id: ''
})

const fetchItems = async () => {
    const res = await axios.get('/items')
    items.value = res.data
}

const fetchCategories = async () => {
    const res = await axios.get('/categories')
    categories.value = res.data
}

const submitForm = async () => {
    await axios.post('/items', form.value)
    form.value = { nama: '', jumlah: 1, harga: 0, gambar_url: '', category_id: '' }
    fetchItems()
}

onMounted(() => {
    fetchItems()
    fetchCategories()
})
</script>

<style>
.container {
    max-width: 600px;
    margin: 20px auto;
    padding: 16px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
}

h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #333;
}

form {
    margin-bottom: 24px;
}

form>div {
    margin-bottom: 12px;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #555;
}

input[type='text'],
input[type='number'],
select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

input[type='text']:focus,
input[type='number']:focus,
select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 4px #3b82f6;
}

button[type='submit'] {
    background-color: #3b82f6;
    color: white;
    padding: 10px 20px;
    font-weight: 600;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type='submit']:hover {
    background-color: #2563eb;
}

ul {
    list-style: none;
    padding-left: 0;
}

li {
    background: white;
    padding: 14px 16px;
    border-radius: 8px;
    box-shadow: 0 1px 5px rgb(0 0 0 / 0.1);
    margin-bottom: 12px;
}

li strong {
    font-size: 1.1rem;
    color: #222;
}

li div {
    margin-top: 6px;
    color: #555;
}

img {
    margin-top: 8px;
    max-width: 150px;
    border-radius: 6px;
    border: 1px solid #ddd;
    display: block;
}
</style>
