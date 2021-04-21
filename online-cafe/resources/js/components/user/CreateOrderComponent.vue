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
                        <button class="btn btn-success btn-m m-1" @click.prevent="increaseQuantity(product.id)">+</button>
                        <button class="btn btn-warning btn-m m-1" @click.prevent="decreaseQuantity(product.id)">-</button>
                        </div> <!-- Action !-->
                    <div class="col-3 text-center m-auto w-auto"><label for="text" class="text">{{ formatPrice(product.price * product.quantity) }}</label></div> <!-- Product Price !-->
                    <div class="col-2 text-dark m-auto"> <button class="btn btn-danger"  @click.prevent="removeProduct(product.id)">X</button></div> <!-- Delete  Product !-->
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
                                :src="product.image"
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
import services  from '../../services/orders';
import {user} from '../../app';
export default {
    async created(){
        this.getData();
    }
    ,data() {
        return {
            order: {
                products: [],
                notes: "",
                totalPrice: 0,
                room: null,
                user: user,
            },
            products: [],
            rooms: [],
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
            if(product.quantity > 0)  {
                product.quantity -= 1
                this.order.totalPrice -= product.price;
            }
            
        },
        formatPrice(price){
            const formater = Intl.NumberFormat('eg-SA',{
                   style: 'currency', currency: 'EGP' 
                   })
            return formater.format(price);
        },
        removeProduct(productId){
            // const productIndex = this.order.products.findIndex((product) => product.id === productId);
            let productIndex;
            for(let index = 0; index < this.order.products.length; index++){
                if(this.order.products[index].id == productId) {
                    productIndex = index;
                    break;
                }
            }
                            console.log("removing", productIndex);

            const product = this.getProductFromOrder(productId);
            if(productIndex !== -1){
                console.log("removing", productIndex);
                this.order.totalPrice -= (product.price *  product.quantity);
                this.order.products.splice(productIndex, 1);
            }else{
                console.log("Error removing INdex -1");
            }

        },
        addProduct(productId){
            const product2 = this.getProductFromOrder(productId)
            if(product2){
                product2.quantity += 1;
                this.order.totalPrice += product2.price;
            }else{
                const product = this.products.find(product => product.id === productId);
                this.order.products.push({"quantity": 1,...product});
                this.order.totalPrice += product.price; 
            }
            
        },
        confirmOrder(){
            if(this.order.products.length > 0) {
                // attach the room object to order insted of name
                const room = this.rooms.find(room => room.name == this.order.room);
                this.order.room = room;
                this.submitOrder()

            }else {
                console.log("Order With No Products Selected");
            }
        },
        async submitOrder(){
            try {
                const res =  await services.submitOrder(this.order);
                 console.log(res.data);
                 window.location = "/home";
            } catch (error) {
                console.log("Submiting Order error \n \n \n ", error);
            }
            
           
        },
        async getProducts(){
            const products = await services.getProducts();
            this.products = products.data;
            console.log(products.data);
        },
         async getRooms(){
            const products = await services.getRooms();
            this.rooms = products.data;
            console.log(products.data);

        },
         async getData(){
            this.getRooms();
            this.getProducts();
        }

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