<template>
    <div class="container">
    <div class="row">
        <form v-on:submit.prevent="adduser">
            <div class="form-group">
                <lable>Name</lable>
                <input type="text" class="form-control" name="name" v-model="user.name" />
            </div>

            <div class="form-group">
                <lable>email</lable>
                <input type="email" class="form-control" name="email" v-model="user.email" />
            </div>

            <div class="form-group">
                <lable>Room number</lable>
                <select name="room_id" class="form-control " >

                  <!--  <option v-for="room in rooms" :value="room.id">{{room['number']}}</option>  -->
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">create</button>
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
                user: {}
            }
        },
     
        methods: {
            adduser() {
                    console.log(this.user);
                    // console.log(this.$route.params.id)
                axios
                    .post("/api/userstore", this.user)
                    .then((res) => {
                        this.$router.push({ name:'alluser'});
                    });
            }
        }
    }
</script>
