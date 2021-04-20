<template>
    <div class="container">
        <div class="row">
            <form class="col-4 p-3" @submit.prevent="confirmOrder()">
                <div class="row  align-content-center" v-for="product in order.products" :key="product.id"> <!-- contorles -->
                    <div class="col-2 text-dark m-auto"><label for="" class="text">{{ product.name }}</label></div> <!-- Product name !-->
                    <div class="col-1 text-success m-auto">
                        <label for="" class="text text-center">{{ product.quantity }}</label>
                        </div> <!-- Product Quantity !-->
                    <div class="col-4 text-center m-auto">
                        <button class="btn btn-success btn-m m-1" @click="increaseQuantity(product.id)">+</button>
                        <button class="btn btn-warning btn-m m-1" @click="decreaseQuantity(product.id)">-</button>
                        </div> <!-- Action !-->
                    <div class="col-3 text-center m-auto w-auto"><label for="text" class="text">{{ formatPrice(product.price * product.quantity) }}</label></div> <!-- Product Price !-->
                    <div class="col-2 text-dark m-auto"> <button class="btn btn-danger"  @click="removeProduct(product.id)">X</button></div> <!-- Delete  Product !-->
                </div>
                
                
                <div class="row py-3"> <!-- Notes -->
                    <div class="col-12">
                     <label for="notes" class="text" >Notes</label>
                        <textarea name="notes" id="order-notes" cols="35" rows="10" v-model="order.notes"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <label for="notes" class="text " >Rooms</label>
                        <select required v-model="order.room" name="rooms" id="rooms" class="float-right">
                            <option v-for="room in rooms" :key="room.id">{{room.name}}</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-column float-right mr-2 text-center
                        "> 
                            <label for="total-price">{{ formatPrice(order.totalPrice) }}</label>
                            <button class="btn btn-success m-auto">Confirm</button>
                        </div>
                    </div>
                </div>
            </form> <!-- create order  -->
            <div id="products" class="col-8 py-3 ">
                <div class="row justify-content-center">
                    <div class="card m-2 p-2" style="width: 12rem;" v-for="product in products" :key="product.id">
                        <img
                                src="../../../images/tea.jpg"
                                class="card-img-top img"
                                style="height: 80%;"
                                alt="..."
                                @click="addProduct(product.id)"
                        />
                        <div class="card-body align-baseline"  style="position: relative;">
                            <h3 class="card-title blue-text">{{product.name}}</h3>
                            <h6 class="card-text details-value">{{ formatPrice(product.price) }}</h6>
                            <a href="#" @click.prevent="addProduct(product.id)" class="btn btn-primary m-1" style="position: absolute; bottom: 0; right: 10%; "
                            >Add </a
                            >
                        </div>
                    </div>

                </div>
            </div><!-- display products !-->
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            order: {
                products: [],
                notes: "",
                totalPrice: 0,
                room: null,
            },
            products: [
                {id: 1, name: "Tea", quantity: 1 ,price: 5 }, 
                {id: 2, name: "Water", quantity: 1 ,price: 2.5 }, 
                {id: 3, name: "Cofe", quantity: 1 ,price: 7 }
                ],
            rooms: [
                    {id: 1, name: "room1"},
                    {id: 2, name: "room2"},
                    {id: 3, name: "room3"},
                    ],
        }    
    },
    methods:{
        getProductFromOrder(productId){
            return this.order.products.find((product) => product.id === productId);
        },
        increaseQuantity(productId){
            const product = this.getProductFromOrder(productId);
            this.order.totalPrice += product.price;
            product.quantity += 1

        },
        decreaseQuantity(productId){
            const product = this.getProductFromOrder(productId);
            if(this.order.totalPrice > 0) this.order.totalPrice -= product.price;
            if(product.quantity > 0)  product.quantity -= 1
        },
        formatPrice(price){
            const formater = Intl.NumberFormat('eg-SA',{
                   style: 'currency', currency: 'EGP' 
                   })
            return formater.format(price);
        },
        removeProduct(productId){
            const porductIndex = this.order.products.findIndex((product) => product === productId);
            this.order.totalPrice -= this.getProductFromOrder(productId).price *  this.getProductFromOrder(productId).quantity;
            this.order.products.splice(porductIndex, 1);

        },
        addProduct(productId){
            const product = this.products.find(product => product.id === productId);
            this.order.products.push({...product});
            this.order.totalPrice += product.price;
        },
        confirmOrder(){
            if(this.order.products.length > 0) {
                // submitOrder(this.order);
                console.log(this.order);

            }else {
                console.log("NUll");

            }
        },
        submitOrder(order){
        },

    },

}
</script>

<style scoped>
.text{
    font-size: large;
    font-weight: 500;
}

.img:hover{
    transform: scale(1.2);
    cursor: pointer;
}
</style>