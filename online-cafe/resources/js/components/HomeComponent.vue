<template>
    <div class="container">
        <!-- <div v-if="user.is_admin == 1"> -->
            <h3>Admin </h3>
            <router-link :to="{name: 'allProducts'}">All Products</router-link>
        <!-- </div> -->
        <!-- <div v-if="user.is_admin == 0"> -->
            <!-- <h3>User </h3> -->

        <!-- </div>  -->
        
    </div>

</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'

    export default {
        data(){
            user:[]
        },
        mounted() {
            console.log('Component mounted.');
            axios.get('/api/user').then(response => {
                console.log(response.data.is_admin);
                this.user = response.data ;
            })
        },
        
    }
</script>
