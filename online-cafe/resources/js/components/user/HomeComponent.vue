<template>
    <div class="container">
        <div class="row">
            <latest-order-componenet :user="user" />
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import LatestOrderComponenet from './LatestOrderComponent.vue';
import {user}  from '../../app';
    export default {
        mounted() {
            console.log('Home Component mounted.');
        },
        data(){
            return {
                user: user,
            }
        },
        components: {
            LatestOrderComponenet,
        }
    }
</script>