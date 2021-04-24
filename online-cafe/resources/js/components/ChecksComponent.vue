<template>
  <div>
    <h1>Checks</h1>
    <br>
    <form action="/api/checks" method="POST" @submit.prevent="submitform">
      <div class="form-row">
        <div class="col">
          <label for="start_date">Start Date</label>
          <input
            type="date"
            class="form-control"
            name="start"
            v-model="start"
          />
        </div>
        <div class="col">
          <label for="end_date">End Date</label>
          <input type="date" class="form-control" name="end" v-model="end" />
        </div>
      </div>
      <br /><br />
      <div class="form-row">
        <div class="col">
          <label for="user">User</label>
          <select
            class="form-control"
            id="exampleFormControlSelect1"
            name="selectedUser"
            v-model="selectedUser"
          >
            <option v-for="user in users" :key="user.id">
              {{ user.name }}
            </option>

            <option>All</option>
          </select>
        </div>
      </div>
      <br />
      <button type="submit" class="btn btn-warning" style="float: right">
        Submit
      </button>
    </form>
    <br /><br />

    <table class="table table-striped">
      <thead class="bg-info">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Total Amount</th>
        </tr>
      </thead>
     
        <tbody v-if="userDisplay == true">
          <tr>
            <td>
              <button
                type="button"
                class="btn btn-info"
                @click="orderDisplay = true"
              >
                {{ data_of_user['user'].name }}
              </button>
            </td>
            <th >{{ data_of_user['totalAmount'] }}</th>
          </tr>
        </tbody>
     
    </table>

    <div v-if="orderDisplay">
      <table class="table table-hover table-primary mt-5">
        <thead>
          <tr>
            <th scope="col">Order Date</th>
            <th scope="col">Amount</th>
          </tr>
        </thead>
        <tbody>
          
          <tr v-for="order in data_of_user['orders']" :key="order.id">
            <td>
              <button
                type="button"
                class="btn btn-primary"
                @click="orderClicked(order.id)"
              >
                {{order.created_at}}
              </button>
            </td>
            <th>{{order.total_price}}</th>
            <th><router-link v-bind:to="'/checkOrder/'+order.id">Details</router-link></th>
          </tr>
          
          
        </tbody>
      </table>
      <button
        type="button"
        class="btn btn-danger"
        style="float: right"
        @click="orderDisplay = false"
      >
        Hide
      </button>
    </div>

    <div
      v-if="orderDetailsDisplay == true"
      class="p-3 mb-2 mt-5 text-primary"
      style="background-color: #F0F0F0"
    >
      <div class="d-flex flex-row">
        <div class="p-2" v-for="product in selectedOrderProducts" :key="product.id" style="display:inline">
          <h4 >{{product.name}} </h4>
          <p >{{product.pivot.quantity}}</p>
        </div>

        
        
      </div>
    
    </div>
    <button v-if="orderDetailsDisplay==true"
            type="button"
            class="btn btn-danger"
            style="float:right"
            @click="orderDetailsDisplay = false"
          >
            Hide
          </button>
    
  </div>
</template>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000";

export default {
  data() {
    return {
      orderDetailsDisplay: false,
      orderDisplay: false,
      userDisplay: false,
      users: [],
      start: "",
      end: "",
      selectedUser: "",
      data_of_user: [],
      selectedOrderId:"",
      selectedOrderProducts:[],
    };
  },
  //mounted() {},
  methods: {
    getUsers() {
      axios
        .get("/api/checks")
        .then((response) => {
          this.users = response.data;
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    submitform() {
      axios
        .post("/api/checks", {
          selectedUser: this.selectedUser,
          start: this.start,
          end: this.end,
        })
        .then((response) => {
          this.userDisplay=true;
          this.data_of_user = response.data;
          
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    orderClicked(order_id)
    {
      this.orderDetailsDisplay=true;
      this.selectedOrderId=order_id;
      // for (let i = 0; i < this.data_of_user["orders"].length; i++) {
      //     if(this.data_of_user["orders"][i].id==this.selectedOrderId)
      //     {
      //          this.selectedOrder=this.data_of_user["orders"][i];
      //          console.log(this.selectedOrder.products);
      //          break;
      //     }
      //   } 
      
      axios
        .post("/api/checks/products", {
          selectedOrderId: this.selectedOrderId,
        })
        .then((response) => {
          this.selectedOrderProducts=response.data
          
        })
        .catch(() => {
          console.log("Error...");
        });
    }
    
  },
  created() {
    this.getUsers();
  },
};
</script>