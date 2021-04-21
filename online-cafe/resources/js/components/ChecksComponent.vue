<template>
  <div>
    <h1>Checks</h1>
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
                {{ user.name }}
              </button>
            </td>
            <th >100</th>
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
          <tr>
            <th scope="row">
              <button
                type="button"
                class="btn btn-primary"
                @click="(orderDetailsDisplay = true), (index = 0)"
              >
                2021-04-10
              </button>
            </th>
            <td>25</td>
          </tr>
          <tr>
            <th scope="row">
              <button
                type="button"
                class="btn btn-primary"
                @click="(orderDetailsDisplay = true), (index = 1)"
              >
                2021-03-25
              </button>
            </th>
            <td>100</td>
          </tr>
          <tr>
            <th scope="row">
              <button
                type="button"
                class="btn btn-primary"
                @click="(orderDetailsDisplay = true), (index = 2)"
              >
                2020-10-10
              </button>
            </th>

            <td>10</td>
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
      style="background-color: #e8e8e8"
    >
      <div class="d-flex flex-row">
        <div class="p-2">
          <h4>{{ orderDetails[index] }}</h4>
        </div>
        <div style="float: right">
          <button
            type="button"
            class="btn btn-danger"
            @click="orderDetailsDisplay = false"
          >
            Hide
          </button>
        </div>
      </div>
    </div>
    
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
      orderDetails: ["Tea", "Coffe", "Orange Juice"],
      index: 0,
      users: [],
      start: "",
      end: "",
      selectedUser: "",
      user: {},
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
          this.user = response.data;
          
        })
        .catch(() => {
          console.log("Error...");
        });
    },
  },
  created() {
    this.getUsers();
  },
};
</script>