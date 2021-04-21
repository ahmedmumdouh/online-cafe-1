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

import axios from "axios";
import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import Admin from "./components/AdminComponent.vue";
import test from "./components/testComponent.vue";
import User from "./components/UserComponent.vue";
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000";

// routes
const loadUserGroupComponents = (componenet) => {
    return import(
        /* webpack-ChunkName: 'userGroup' */ `./components/user/${componenet}.vue`
    );
};
const UserRoutes = [
    {
        path: "/home",
        name: "home",
        component: loadUserGroupComponents("HomeComponent"),
    },
    {
        path: "/create-order",
        name: "create-order",
        component: loadUserGroupComponents("CreateOrderComponent"),
    },
    {
        path: "/my-order",
        name: "my-order",
        component: loadUserGroupComponents("AllOrdersComponenet"),
    },
    { path: "/:catchAll(.*)", component: import("./components/handler.vue") },
];

const AdminRoutes = [
    { path: "/home", component: test },
    { path: "/:catchAll(.*)", component: import("./components/handler.vue") },
];
export let user;
window.addEventListener("load", function (e) {
    const userRouter = createRouter({
        history: createWebHistory(),
        routes: UserRoutes,
    });
    const adminRouter = createRouter({
        history: createWebHistory(),
        routes: AdminRoutes,
    });
    axios.get("/api/user").then((response) => {
        if (response.data.is_admin) {
            createApp(Admin).use(adminRouter).mount("#main");
            user = response.data;
        } else {
            createApp(User).use(userRouter).mount("#main");
            user = response.data;
        }
    });
});
