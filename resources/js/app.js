import './bootstrap';
import { createApp } from 'vue'
import axios from 'axios'
import ItemManager from './components/ItemManager.vue'

axios.defaults.baseURL = 'http://localhost:8000/api' // tambahkan /api kalau route API ada di routes/api.php

const app = createApp({})
app.component('item-manager', ItemManager)
app.mount('#app')
