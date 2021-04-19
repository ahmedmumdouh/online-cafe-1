<template>
    <div class="container">
        <div class="row">
            <div class="col-4 p-3">
                <div class="row  align-content-center"> <!-- contorles -->
                    <div class="col-2 text-dark m-auto"><label for="" class="text"> Tea</label></div> <!-- Product name !-->
                    <div class="col-1 text-success m-auto">
                        <label for="" class="text text-center">5</label>
                        </div> <!-- Product Quantity !-->
                    <div class="col-4 text-center m-auto">
                        <button class="btn btn-success btn-m m-1">+</button>
                        <button class="btn btn-warning btn-m m-1">-</button>
                        </div> <!-- Action !-->
                    <div class="col-3 text-center m-auto w-auto"><label for="text" class="text">EGP 251</label></div> <!-- Product Price !-->
                    <div class="col-2 text-dark m-auto"> <button class="btn btn-danger">X</button></div> <!-- Delete  Product !-->
                </div>
                
                
                <div class="row py-3"> <!-- Notes -->
                    <div class="col-12">
                     <label for="notes" class="text" >Notes</label>
                        <textarea name="notes" id="order-notes" cols="35" rows="10"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <label for="notes" class="text " >Rooms</label>
                        <select name="rooms" id="rooms" class="float-right">
                            <option value="">Room1</option>
                            <option value="">Room2</option>
                            <option value="">Room3</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-column float-right mr-2 text-center
                        "> 
                            <label for="total-price">EGP 55 </label>
                            <button class="btn btn-success m-auto">Confirm</button>
                        </div>
                    </div>
                </div>
            </div> <!-- create order  -->
            <div id="products" class="col-8 py-3 ">
                <div class="row">
                    <div class="card m-2 p-2" style="width: 15rem;">
                        <img
                                src="../../../images/tea.jpg"
                                class="card-img-top img"
                                style="height: 80%;"
                                alt="..."
                        />
                        <div class="card-body justify-content-between"  style="position: relative;">
                            <h3 class="card-title blue-text">Tea</h3>
                            <h6 class="card-text details-value">5EGP</h6>
                            <a href="#" class="btn btn-primary m-1" style="position: absolute; bottom: 0; right: 10%; "
                            >Add </a
                            >
                        </div>
                    </div>
                    <div class="card m-2 p-2" style="width: 15rem;">
                        <img
                                src="../../../images/tea.jpg"
                                class="card-img-top img"
                                style="height: 80%;"
                                alt="..."
                        />
                        <div class="card-body justify-content-between"  style="position: relative;">
                            <h3 class="card-title blue-text">Tea</h3>
                            <h6 class="card-text details-value">5EGP</h6>
                            <a href="#" class="btn btn-primary m-1" style="position: absolute; bottom: 0; right: 10%; "
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
            product: null
        }    
    },
    methods:{
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