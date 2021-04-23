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
                   <!-- <div class="form-group">
                        <label>Room</label>
                        <input type="text" class="form-control">
                    </div>-->

                    <div class="custom-file mb-3">
                <label for="Image">Your Profile</label>
                <div class="imagePreviewWrapper"  ></div>
                <input type="file" name="avatar" class="" v-on:change="onChange" id="validatedCustomFile" accept="image/*" required>
                </div>
                    <br>
                    <br>
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
                user:{name:'',}


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

            const formData = new FormData()
            formData.append("_method", "patch");
            formData.append('avatar', this.user.avatar)
            formData.append('name', this.user.name)
            // formData.append('email', this.user.email)
            // formData.append('password', this.user.password)
            // formData.append('room_id', this.user.room_id)
            axios
                .post(`/api/useredit/${this.$route.params.id}`, formData)
                .then((res) => {
                    this.$router.push({
                        name: "alluser",
                    });
                    //  this.user = res.data;
                });
        },

        onChange(e) {
            this.user.avatar = e.target.files[0];
            this.imageName = e.target.files[0].name;
            this.url = URL.createObjectURL(this.user.avatar);
            console.log(this.user);
        },
        //     updateuser() {
        //             console.log(this.user);
        //             console.log(this.$route.params.id)
        //         axios
        //             .patch(`/api/useredit/${this.$route.params.id}`, this.user)
        //             .then((res) => {
        //                 this.$router.push({ name:'alluser'});
        //             });
        //     }
        // }
        }}
</script>