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


            <div class="custom-file mb-3">
                        <input type="file" name="avatar" class="custom-file-input" v-on:change="onChange" id="validatedCustomFile" accept="image/*"  required>
                        <label class="custom-file-label"  for="validatedCustomFile">{{imageName}}</label>
                        <div class="invalid-feedback">Cover Photo</div> 
                        <div id="preview" style="margin-top: 1%;">
                            <img v-if="url" :src="url" />
                        </div>
                    </div>

            <!-- <div class="form-group">
                <lable>Room number</lable>
                <select name="room_id" class="form-control " > -->

                  <!--  <option v-for="room in rooms" :value="room.id">{{room['number']}}</option>  -->
                <!-- </select>
            </div> -->
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
              form:{
                        name:'',
                        email:'',
                        avatar:''
                    },
                    imageName:'Upload Cover Photo',
                    url: null,
            }
        },
     
        methods: {

          onChange(e) {
                this.form.avatar = e.target.files[0];
                this.imageName = e.target.files[0].name; 
                this.url = URL.createObjectURL(this.form.avatar);
                console.log(this.form);
            },

             onSubmit(e) {
                e.preventDefault();
                const existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }            
                const formData = new FormData()
                formData.append('avatar', this.form.avatar)
                formData.append('name', this.form.name)
               formData.append('email', this.form.email)

              
                axios.post("/api/userstore", formData,config).then(function (res) {
                        existingObj.success = res.data.success;
                        existingObj.$router.push({ name: 'alluser' })
                        console.log(res);
                    })
                    .catch(function (err) {
                        existingObj.output = err;
                    });
            }  
        }



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