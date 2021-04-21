/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

// window.Vue = require("vue").default;

// const app = new Vue({
//     el: '#app',
// });

// let app = createApp({});
// app.component("example", require("./components/ExampleComponent.vue").default);  // for tags
// app.mount("#main");





import { createApp } from "vue";
import User from "./components/UserComponent.vue";
import Admin from "./components/AdminComponent.vue";
import Home from "./components/HomeComponent.vue";
import handler from "./components/handler.vue";
import test from "./components/testComponent.vue";
import AllProducts from './components/Admin/AllProductsComponent.vue'
import AddProduct from './components/Admin/AddProductComponent.vue'
import UpdateProduct from './components/Admin/UpdateProductComponent.vue'


import { createWebHistory , createRouter } from "vue-router";

import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'

// routes

const UserRoutes = [
    {name: 'home',path:'/home',component:Home},
    {name: 'handler',path:'/:catchAll(.*)',component: handler},
];

const AdminRoutes = [
    {name: 'home', path:'/home',component:Home},
    {name: 'allProducts', path:'/products',component:AllProducts},
    {name: 'addProduct', path:'/add_product',component:AddProduct},
    {name: 'updateProduct', path:'/update_product/:productId',component:UpdateProduct},
    {name: 'handler', path:'/:catchAll(.*)',component:handler},
];




window.addEventListener('load',function(e){
    const userRouter = createRouter({history:createWebHistory(),routes:UserRoutes});
    const adminRouter = createRouter({history:createWebHistory(),routes:AdminRoutes});
    
    axios.get('/api/user').then(response => {
        console.log(response.data.is_admin );
        if( response.data.is_admin ){
            createApp(Admin).use(adminRouter).mount('#main')
        }
        else{
            createApp(User).use(userRouter).mount('#main')
        }
    })
        
})

//  latest +  admin + user compo
//  
//      latest orders  ->              /home 
// router view admin    -> admin comp  /home 
// 













