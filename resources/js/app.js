require('./bootstrap')

import { createApp } from 'vue'
import { VueRouter } from 'vue-router';
import Dashboard from './components/Dashboard'

const app = createApp({})

app.component('welcome', Dashboard)

app.mount('#app')