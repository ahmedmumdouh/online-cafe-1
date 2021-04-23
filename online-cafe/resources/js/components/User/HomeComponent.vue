<template>
    <div class="container">
        <div class="row">
            <LatestOrderComponenet/>
            <CreatedOrderComponent/>
        </div>
    </div>
</template>

<script>
import LatestOrderComponenet from './LatestOrderComponent';
import CreatedOrderComponent from '../User/CreateOrderComponent';
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
            CreatedOrderComponent,
        }
    }
</script>