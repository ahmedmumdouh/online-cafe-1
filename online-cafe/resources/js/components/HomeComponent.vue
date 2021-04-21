<template>
    <div class="container">
        <div v-if="user==1">
    
        </div>
        
        <div v-if="user==0">
            
        </div>
    </div>

</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'

    export default {
        data(){
            user:0
        },
        mounted() {
            console.log('Component mounted.');
            axios.get('/api/user').then(response => {
                console.log(response.data.is_admin);
                this.user = response.data.is_admin ;
            })
        },
        
    }
</script>
