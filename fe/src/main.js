import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './router'
import App from './App.vue'
import { axiosInterceptors } from './repositories/Repository'
import { useAuthStore } from './stores/auth'

import './css/style.css'
import 'vue3-toastify/dist/index.css'

axiosInterceptors(router)

const app = createApp(App)

app.use(createPinia())
const { getUser } = useAuthStore()

getUser().then(() => {
    app.use(router)
    app.mount('#app')
})
