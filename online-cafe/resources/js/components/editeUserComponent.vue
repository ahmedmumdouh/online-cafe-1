<template>
    <div>
        <h3 class="text-center">Edit User</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateuser">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label>Room</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" >
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
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
        created() {
            axios
                .get(`/api/usershow/${this.$route.params.id}`)
                .then((res) => {
                    this.user = res.data;
                });
        },
        methods: {
            updateuser() {
                    console.log(this.user);
                    console.log(this.$route.params.id)
                axios
                    .patch(`/api/useredit/${this.$route.params.id}`, this.user)
                    .then((res) => {
                        this.$router.push({ name:'alluser'});
                    });
            }
        }
    }
</script>