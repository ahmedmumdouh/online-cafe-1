<template>
    <div class="container-md">
        <Navbar :user="user"/>
        <div class="row justify-content-center">
            <div class="col-12 py-4">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import Navbar from '../components/user/NavbarComponent.vue';
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'

    export default {
        created() {
            console.log('User Component Created.');
             axios.get('/api/user').then(response => {
                this.user = response.data;
            })
        },
        data(){
            return {
                user: "",
            }
        },
        components: {
            Navbar,
        }
    
    }
</script>

<style scoped>

</style>