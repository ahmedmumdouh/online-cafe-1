<template>
     <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto" >
                        <li class="p-2">
                            <router-link to="/home" class="navbar-brand links">online-cafe</router-link>
                        </li >
                        <li class="p-2">
                            <router-link to="/home" class="navbar-brand links">Home</router-link>
                        </li>
                        <li class="p-2">
                            <router-link to="/orders" class="navbar-brand links">Orders</router-link>
                        </li>
                        <li class="p-2">
                            <router-link to="/create-order" class="navbar-brand links">Create Order</router-link>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <img :src="user.avatar " :alt=" user.name " />
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
</template>


<script>
import axios from 'axios';
axios.defaults.withCredentials =true;
axios.defaults.baseURL = 'http://localhost:8000';
export default {
    data() {
        return {
           
        }
    },
    methods: {
        logout(){
            axios.post('/logout').then(res => {
                console.log(res);
                window.location = "/"
                }).catch(err =>console.error(err));
        },
    },
    props: ['user']
}
</script>
<style scoped>
.links:hover {
    color: blue ;
    transform: scale(1.5);
    text-decoration: underline;
}
</style>