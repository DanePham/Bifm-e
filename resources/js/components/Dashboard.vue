<template>
    <div class="section-bifm">
        <h1>{{ title }}</h1>
        <form @submit.prevent="submitForm">
            <div class="search"><input v-model="text" ref="q"><button class="ma-2" type="submit">Search</button>
            </div>
        </form>
        <div class="result" v-if="results">
          <div v-for="i in results" :key="i.order_id">
            <img v-bind:src="i.thumb[0].thumbnail_url" /> 
            <p>{{i.name}}</p>
            <p>{{ formatPrice(i.price) }}</p>
            <p>{{i.site_name}}</p>
        </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    setup: () => ({
        title: 'Hi Bro!!!'
    }),
    data() {
    return {
            results: []
        }
    },
    methods: {
        formatPrice(value) {
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        submitForm() {
            axios.get(`http://127.0.0.1:8000/api?q=${this.$refs.q.value}`).then((response) => {
                // console.log(response.data);
                this.results = response.data;
            });
        }
    }
}
</script>