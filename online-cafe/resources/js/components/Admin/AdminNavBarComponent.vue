<template>
     <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto " >
                        <li class="p-2">
                            <router-link to="/home" class="navbar-brand links">online-cafe</router-link>
                        </li >
                        <li class="p-2">
                            <router-link to="/home" class="navbar-brand links">Home</router-link>
                        </li>
                        <li class="p-2">
                            <router-link :to="{name: 'allProducts'}" class="navbar-brand links">Products</router-link>
                        </li>
                        <li class="p-2">
                            <router-link to="{name: 'alluser'}" class="navbar-brand links">Users</router-link>
                        </li>
                        <li class="p-2">
                            <router-link to="/create-order" class="navbar-brand links">Manual Order</router-link>
                        </li>
                        <li class="p-2">
                            <router-link to="/create-order" class="navbar-brand links">Checks</router-link>
                        </li>
                         <li class="p-2">
                            <router-link to="/my-order" class="navbar-brand links"></router-link>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <img :src="user.avatar" :alt="user.name" />
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >{{ user.name}}</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/logout" @click.prevent="logout()">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <div class="container">
            <router-view col-md-12></router-view>
        </div>
</template>
<script>
import axios from 'axios';
axios.defaults.withCredentials =true;
axios.defaults.baseURL = 'http://localhost:8000';
export default {
    data() {
        return {
           user:''
        }
    },
    methods: {
        logout(){
            axios.post('/logout').then(res => {
                window.location = "/"
                }).catch(err =>console.error(err));
        },
    },
    // props: ['user'],
    beforeCreate(){
        const that = this ;
            console.log('Component mounted.');
            axios.get('/api/user').then(response => {
                console.log(response.data)
                that.user = response.data;
                console.log(that.user)
            })
        
    }
}
</script>
<style scoped>
.links:hover {
    color: blue ;
    transform: scale(1.5);
    text-decoration: underline;
}
</style>