<template>
    <div>
        <AdminNavBarComponent v-if="user" :user="user"/>
     
    </div>

</template>

<script>
import axios from 'axios';
axios.defaults.withCredentials =true;
axios.defaults.baseURL = 'http://localhost:8000';
import urls from './services/apiURLs' ; 
import AdminNavBarComponent from './Admin/AdminNavBarComponent.vue'

    export default {
        data(){
            return{
                user: null
            }
            
        },
        beforeCreate() {
           const that = this ;
            console.log('Component mounted.');
            axios.get('/api/user').then(response => {
                console.log(response.data)
                that.user = response.data;
                console.log(that.user);
            })
        },
        components:{
            AdminNavBarComponent,
        }
        
        
    }
</script>
