




<template>
<div>
    <h1>Order</h1>
    <br>
<table class="table table-striped mt-3">
        <thead class="bg-info">   
          <tr>
            <th scope="col">Order Date</th>
            <th scope="col">Name</th>
            <th scope="col">Room</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>

          </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{specificOrder["order"].created_at}}</td>
                <td>{{specificOrder["user"].name}}</td>
                <td>{{specificOrder["room"].name}}</td>
                <td>{{specificOrder["order"].status}}</td>
                <td><button
                type="button"
                class="btn btn-success"
                @click="changeStatus(specificOrder['order'].id)"
                :disabled="specificOrder['order'].status == 'done'"
               
              >
                Finish Order
              </button></td>


            </tr>
        </tbody>
</table>
<br><br>
<h1>Order Details</h1>
    <br>
<table class="table table-striped mt-3">
        <thead class="bg-info">   
          <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            

          </tr>
        </thead>
        <tbody>
            <tr v-for="product in specificOrder['products']" :key="product.id">
                <td>{{product.name}}</td>
                <td>{{product.price}}</td>
                <td>{{product.pivot.quantity}}</td>
                

            </tr>
            <tr ><td ><h3 style="color:#00FF80">Total Price={{specificOrder["order"].total_price}}</h3></td></tr>
        </tbody>
</table>

</div>

</template>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000";
export default {
  data() {
    return {
        id:this.$route.params.id,
        specificOrder:[],
      
    };
  },
  
  methods: {
       getOrder() {
      axios
        .post("/api/checkOrder",{orderId:this.id})
        .then((response) => {
          this.specificOrder = response.data;
          
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    changeStatus(ID){
         axios
        .put("/api/checkOrder",{orderId:this.id})
        .then((response) => {
          alert("done");
          location.reload();
          
          
        })
        .catch(() => {
          console.log("Error...");
        });
        
    },
    
  },
  created() {
    this.getOrder();
  },
};
</script>