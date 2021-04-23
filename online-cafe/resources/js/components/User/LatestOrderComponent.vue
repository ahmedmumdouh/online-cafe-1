<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" v-if="latestOrder">
                <div class="card">
                    <div class="card-header">Latest Order</div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="card m-2 p-2" style="width: 12rem;" v-for="product in latestOrder.products" :key="product.id">
                                        <img
                                                :src="product.image"
                                                class="card-img-top img"
                                                style="height: 80%;"
                                                alt="..."
                                        />
                                        <div class="card-body align-baseline"  style="position: relative;">
                                            <h3 class="card-title blue-text">{{product.pivot.quantity}} {{product.name}}</h3>
                                            <h6 class="card-text details-value">{{ formatPrice(product.price) }}</h6>
                                        </div>
                                        
                                    </div>
                                </div>
                            <div class="card-footer">
                                    <small class="text-right text-muted ">Total Price {{formatPrice(latestOrder.order.total_price)}}</small>
                            </div>
                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { user } from '../../app'
import services from '../../services/orders';
export default {
    async created(){
        const latestOrder = await services.getLatestOrder(this.user.id);
        this.latestOrder = latestOrder.data;
        console.log("Latest Order Created \n\ ", latestOrder.data);
    },
    data() {
        return {
            user: user,
            latestOrder: false,
        }
    },
    methods: {
        formatPrice(price){
            const formater = Intl.NumberFormat('eg-SA',{
                   style: 'currency', currency: 'EGP' 
                   })
            return formater.format(price);
        },
    },
}
</script>