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
        specificOrder:{},
      
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
    
  },
  created() {
    this.getOrder();
  },
};
</script>