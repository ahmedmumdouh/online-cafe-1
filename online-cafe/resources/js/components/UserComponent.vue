<template>
    <div class="container">
       
        <h3>User </h3>
        <router-link :to="{name: 'home'}">home</router-link>              
        <router-view col-md-12></router-view>
    
    </div>        

</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'

    export default {
        mounted() {
            console.log('Component mounted.');
            axios.get('/api/categories').then(response => {
                console.log(response.data)
            })
        },
    
    }
</script>
