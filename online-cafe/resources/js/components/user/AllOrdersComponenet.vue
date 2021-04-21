<template>
    <div class="container">
        <div class="row">
            {{orders}}
        </div>
    </div>
</template>

<script>
import {user} from '../../app';
import service from '../../services/orders';

export default {
    async created(){
        const orders = await service.getOrders(user.id);
        console.log("AllOrderComponent Created,", orders.data);
        this.orders = orders.data;
    },
    data(){
        return{
            orders: "",
            user: user,
        }
    },
    methods: {
        
    }
}
</script>
