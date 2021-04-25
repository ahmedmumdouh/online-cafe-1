<template>
    <div class="container">

        <!-- Date Filter End -->
        <h1>My Order </h1>
        <div class="row m-2">
            <label for="startDate" class="col-sm-2 col-form-label">Date From</label>

            <div class="col-sm-3 d-inline-block"> <!-- Start Date -->
                <input v-model="startDate" name="startDate" aria-placeholder="Date From" type="datetime-local" class="form-check-input">
            </div>

                <label for="endDate" class="col-sm-2 col-form-label" aria-placeholder="Date To">Date To</label>

            <div class="col-sm-3 d-inline-block"> <!-- End Date -->
                <input v-model="endDate" name="endDate" type="datetime-local" class="form-check-input">
            </div>

            <div class="col-sm-2 d-inline-block"> <!-- End Date -->
                <button id="get-orders"  @click.prevent="getOrderByDate()" class="btn btn-info">Get</button>
            </div>
        </div>

        <div class="row" v-if="dateErrorMessages">
            <div class="alert alert-danger m-auto">
                <p class="p-1">{{dateErrorMessages}}</p>
            </div>
        </div>

        <div class="row" v-if="dateInfoMessages">
            <div class="alert alert-info m-auto">
                <p class="p-1">{{dateInfoMessages}}</p>
            </div>
        </div>
        <!-- Date Filter End -->


        
        <!-- Orders Start  -->
        <div class="row m-2">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Order Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Amoutn</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="clickable"  v-for="order in orders.data" :key="order.id" >
                        <td @click="displayDetails(order.id)">{{changeDateFormat(order.created_at)}}</td>
                        <td @click="displayDetails(order.id)">{{order.status}}</td>
                        <td @click="displayDetails(order.id)">{{formatPrice(order.total_price)}}</td>
                        <td><button @click="cancleOrder(order.id)" class="btn btn-danger" v-if="order.status=== 'processing'">Cancel</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Orders  End -->

        <!--  -->
            <PaginationComponent v-if="orders.links" :links="orders.links" @paginate="getData"/>
        <!--  -->
       <!-- Order start  End -->
        <div class="row justify-content-center">
            <div class="col-md-8" v-if="orderDetails">
                <div class="card">
                    <div class="card-header">Order Details </div>
                            <div class="card-body p-0">
                                <div class="row justify-content-center">
                                    <div class="card m-2 " style="width: 12rem;" v-for="product in orderDetails.products" :key="product.id">
                                        <img
                                                :src="imageServerURL+product.image"
                                                class="card-img-top img"
                                                style="height: 80%;"
                                                alt="..."
                                        />
                                        <!-- <div class="card-body align-baseline"  style="position: relative;">
                                            <h3 class="card-title blue-text">{{product.pivot.quantity}} {{product.name}}</h3>
                                            <h6 class="card-text details-value">{{ formatPrice(product.price) }}</h6>
                                        </div> -->

                                          <div class="d-flex w-100 justify-content-between mb-3 align-baseline">
                                            <div class="row col-6 ">
                                                <div style="align-self: center; font-family: fantasy; font-size: x-large; padding-left: 7%;color: crimson;"> {{product.name}}</div> 
                                            
                                                
                                            </div>
                                            
                                            <div class="row col-6">
                                                <div class="" style="align-self: center;">{{ formatPrice(product.price) }}</div>
                                                <div class="" style="align-self: center;">Qty: {{product.pivot.quantity}}</div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            <div class="card-footer">
                                    <small class="text-right text-muted ">Total Price {{formatPrice(orderDetails.total_price)}}</small>
                            </div>
                                
                    </div>
                </div>
              
            </div>
        </div>
        
    </div>
</template>

<script>
import {user} from '../../app';
import service from '../../services/orders';
import PaginationComponent from '../Shared/PaginationComponent.vue';

import urls from '../services/apiURLs';
export default {
    async created(){
        this.imageServerURL = urls.imageServerURL ;
        const orders = await service.getOrders(user.id);
        this.orders = orders.data;
    },
    data(){
        return{
            orders: "",
            user: user,
            startDate: null,
            endDate: null,
            orderDetails: false,
            dateErrorMessages: null,
            dateInfoMessages: null,
            imageServerURL:''
        }
    },
    components: {
        PaginationComponent,
    },
    methods: {
        formatPrice(price){
            const formater = Intl.NumberFormat('eg-SA',{
                   style: 'currency', currency: 'EGP' 
                   })
            return formater.format(price);
        },
        async displayDetails(orderId){
            const products = await this.getOrderProducts(orderId);
            console.log(products.data);
            this.orderDetails = this.getOrderFromAllOrders(orderId);
            this.orderDetails.products = products.data;            
        },
        cancleOrder(orderId){
        },
        getOrderFromAllOrders(orderId){
            return this.orders.data.find((order) => order.id === orderId);
        },
        async getOrderProducts(orderId){
            return await service.getOrderProducts(orderId); 
        },
        async getData(orders){
            this.updateCurrentOrders(orders);
        },

        async getOrderByDate(){
            // verify the two date is not null, but the max date as the last created one,
            if(!this.startDate || !this.endDate) return this.dateErrorMessages = "The two date fields are required!";

            const date = {start_date: this.startDate, end_date: this.endDate}
            const orders = await service.getOrders(this.user.id,date);
            this.cleareDateMessages();
            // is there any order this the give date 
            if(orders.data.data.length > 0){
                this.updateCurrentOrders(orders);
            }else{
                this.dateInfoMessages = "No Orders within this date!"
            }
        },
        changeDateFormat(date){
            const newDate = new Date(date);
            return newDate.toLocaleString();
        },
        cleareDateMessages(){
            this.dateErrorMessages = null;
            this.dateInfoMessages = null;
        },
        updateCurrentOrders(orders){
            console.log(orders.data ," Updateing")
            this.orders = orders.data;
            console.log(this.orders ," this.order")

            this.numberOfPages = Math.ceil(orders.data.total / orders.data.per_page);
            
        },
    }
}
</script>



<style scoped>
.clickable:hover{
    cursor: pointer;
    background-color: lightskyblue;
}
</style>
