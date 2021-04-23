<template>
    <div class="container">
    <div class="row">
        <form v-on:submit.prevent="onSubmit">
            <div class="form-group">
                <lable>Name</lable>
                <input type="text" class="form-control" name="name" v-model="form.name" />
            </div>

            <div class="form-group">
                <lable>email</lable>
                <input type="email" class="form-control" name="email" v-model="form.email" />
            </div>

             <div class="form-group">
                <lable>Password</lable>
                <input type="password" class="form-control" name="password" v-model="form.password" />
            </div>

             <div class="form-group">
                <lable>Password Cofirm</lable>
                <input type="password" class="form-control" name="password" v-model="form.confirmpassword" />
            </div>


            <div class="custom-file mb-3">
                        <input type="file" name="avatar" class="custom-file-input" v-on:change="onChange" id="validatedCustomFile" accept="image/*"  required>
                        <label class="custom-file-label"  for="validatedCustomFile">{{imageName}}</label>
                        <div class="invalid-feedback">Cover Photo</div> 
                        <div id="preview" style="margin-top: 1%;">
                            <img v-if="url" :src="url" />
                        </div>
                    </div>

           
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////// -->

        <select class="custom-select" id="validatedInputGroupSelect" v-model="form.rooms" multiple required >
         <option v-for="room in rooms" :key="room.id" :value="room.id" :selected="room.id === form.rooms" >{{room.name}}</option>
             
        </select> 

            <br>            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <button type="submit" name="submit" class="btn btn-primary mg-5">create</button>
        </form>
    </div>
</div>
</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'



 export default {
        data() {
            return {
                // user: {}
                rooms:[],
              form:{
                        name:'',
                        email:'',
                        avatar:'',
                        password:'',
                        confirmpassword:'' , 
                        rooms:[],
                    },
                    imageName:'Upload Cover Photo',
                    url: null,
            }
        },
          mounted(){
               this.getRooms();
          },
        methods: {

          onChange(e) {
                this.form.avatar = e.target.files[0];
                this.imageName = e.target.files[0].name; 
                this.url = URL.createObjectURL(this.form.avatar);
                console.log(this.form);
            },

             onSubmit(e) {
                const existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }  
                if(this.form.confirmpassword===this.form.password){
                    const formData = new FormData()
                    formData.append('avatar', this.form.avatar)
                    formData.append('name', this.form.name)
                    formData.append('email', this.form.email)
                    formData.append('password', this.form.password)
                    formData.append('rooms', this.form.rooms)
                    axios.post("/api/userstore", formData,config)
                    .then((res) => {
                    console.log(res.data)
                        existingObj.$router.push({
                            name: "alluser",
                        });
                    }).catch(function (err) {
                            existingObj.output = err;
                        });
                }          
               
            e.preventDefault();

             },

              getRooms() {
                const that = this ;
                // console.log('hhhhhhhhhhhhhhh')
            axios
                .get("/api/rooms")
                .then((data) => {
                    that.rooms = data.data
                    console.log(data.data)
                    })
                   
                .catch(() => {
                    console.log("Error...");
                });
                     }}, 
                        



            // adduser() {
            //         console.log(this.user);
            //         // console.log(this.$route.params.id)
            //     axios
            //         .post("/api/userstore", this.user)
            //         .then((res) => {
            //             this.$router.push({ name:'alluser'});
            //         });
            // }
        }
    
</script>