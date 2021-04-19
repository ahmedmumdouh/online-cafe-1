<template>
<div class="container">
<div class="row">
<table class="table table-striped table-bordered  table-hover  text-center col-12 ">
<thead>
    <tr>
        <th >Name</th>
        <th>Room</th>
        <th>Image</th>
         <td>Edit</td>
        <td>Delete</td>
    </tr>
</thead>
<tbody>

<tr  v-for="user in users" :key="user.id">
    <td>{{user.name}}</td>
    <td >123</td>
    <td>{{user.avatar}}</td>
     <td><a  href="#" class="btn btn-primary">view</a></td>
     <!-- <td><a href="#" class="btn btn-danger">edit</a></td> -->

      <td>
       <a type="button"
          class="btn btn-danger"
         @click="deleteUser(user.id)">Delete </a>
          </td>
    </tr>
</tbody>

   <!-- <tfoot>
<tr>
<td colspan="4"></td>

 <td></td>

</tr>

</tfoot> -->

 </table>
 <a href="#" class="btn btn-success">Add New User</a>
</div>
</div>

</template>

<script>


import axios from 'axios'
// axios.defaults.withCredentials =true
// axios.defaults.baseURL = 'http://localhost:8000'

    export default {
     data(){
         return{
              users: [],

                  }
             },
    methods:{

      getUsers() {
            axios
                .get("http://localhost:8000/api/userindex")
                .then((data) => (this.users = data.data))
                .catch(() => {
                    console.log("Error...");
                });
                     }, // end of getuser method

         deleteUser(id) {
            axios
                .delete(`http://localhost:8000/api/userdelete/${id}`)
                .then((response) => {
                    let i = this.users.map((data) => data.data).indexOf(id);
                    this.users.splice(i, 1);
                });
                        }, // end of delete method 
             }, //end of methods

     created() {
       
        this.getUsers();
               },
        }

      




</script>

<style>

</style>