import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import VueGoogleMaps from '../node_modules/@fawmi/vue-google-maps'

import './assets/main.css'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyAG2tl6detKdKR5jETqbVT8y7c8baCGoT4',
        libraries: 'places',
    },
});

app.mount('#app')
