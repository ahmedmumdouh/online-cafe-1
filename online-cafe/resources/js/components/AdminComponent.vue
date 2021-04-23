<template>
    <div>
        <AdminNavBarComponent />
     
    </div>

</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'
import AdminNavBarComponent from './Admin/AdminNavBarComponent.vue'

    export default {
        data(){
        },
        beforeCreate() {
           
        },
        components:{
            AdminNavBarComponent,
        }
        
        
    }
</script>
