<template>
    <div class="section-bifm">
        <h1>{{ title }}</h1>
        <form @submit.prevent="submitForm">
            <div class="search"><input v-model="text"><button class="ma-2" type="submit">Search</button>
            </div>
        </form>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    setup: () => ({
        title: 'Hi Bro!!!'
    }),
    methods: {
        submitForm() {
            axios.get('http://127.0.0.1:8000/api/').then((response) => {
                console.log(response);
            });
        }
    }
}
</script>