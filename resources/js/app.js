import './bootstrap'
import { createApp } from 'vue'
import axios from 'axios'
import Biodata from './components/BiodataDetail.vue'

axios.defaults.baseURL = 'http://localhost:8000/api'

createApp(Biodata).mount('#app')
