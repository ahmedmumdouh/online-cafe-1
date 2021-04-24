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
import {user} from '../app.js'
    export default {
        data(){
            user:0
        },
        beforeMount() {
            this.user = user ;
        },
        
    }
</script>
