<template>
    <div class="section-bifm">
        <h1>{{ title }}</h1>
        <form @submit.prevent="submitForm">
            <div class="search"><input v-model="text" ref="q"><button class="ma-2" type="submit">Search</button>
            </div>
        </form>
        <div class="result" v-if="results">
          <ul v-for="i in results" :key="i.order_id">
            <li>
              <p>{{i.name}}</p>
              <p>{{i.price}}</p>
              <p>{{i.description}}</p>
            </li>
          </ul>
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
        submitForm() {
            axios.get(`http://127.0.0.1:8000/api?q=${this.$refs.q.value}`).then((response) => {
                this.results = response.data;
            });
        }
    }
}
</script>