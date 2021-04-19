<template>
    <div class="container">
       <latest-order-componenet/>
    </div>
</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'

import LatestOrderComponenet from './LatestOrderComponenet.vue';

    export default {
        mounted() {
            console.log('Home Component mounted.');
        },
        data(){
            return {

            }
        },
        components: {
            LatestOrderComponenet,
        }
    }
</script>