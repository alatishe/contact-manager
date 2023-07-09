import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import ContactList from './components/ContactList.vue';
import ContactForm from './components/ContactForm.vue';


window.axios = axios;

const app = createApp({});

app.component('contact-list', ContactList);
app.component('contact-form', ContactForm);
app.config.globalProperties.axios = axios;

app.mount('#app');
