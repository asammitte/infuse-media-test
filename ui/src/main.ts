import '@/assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from '@/App.vue'
import router from './router'
import vuetifyPlugin from '@/plugins/vuetify'
import mitt from 'mitt'
const emitter = mitt(); 

const app = createApp(App)
  .provide('emitter', emitter)
  .use(createPinia())
  .use(router)
  .use(vuetifyPlugin)

app.mount('#app')
