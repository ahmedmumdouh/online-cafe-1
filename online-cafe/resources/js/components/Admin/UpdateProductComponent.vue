

<template>
        <div class="card">
            <div class="card-header">
                Update Product
            </div>
             <form  @submit.prevent="onSubmit" >
            <div class="card-body">
              
                    <div class="mb-3">
                            <div class="input-group is-invalid">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="validatedInputGroupPrepend">Product</span>
                            </div>
                            <input type="text" v-model="form.name" class="form-control is-invalid" aria-describedby="validatedInputGroupPrepend" required>
                            </div>
                            <div class="invalid-feedback">
                            
                            </div>
                    </div>

                    <div class="mb-3">
                            <div class="input-group is-invalid">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="validatedInputGroupPrepend">Price</span>
                            </div>
                            <input type="number" v-model.number="form.price" class="form-control is-invalid" aria-describedby="validatedInputGroupPrepend" required>
                            </div>
                            <div class="invalid-feedback">
                            
                            </div>
                    </div>

                     <div class="mb-3">
                        <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="validatedInputGroupSelect">Category</label>
                        </div>
                     
     
                     
                     
                        <select class="custom-select" id="validatedInputGroupSelect" v-model="form.category_id"  required>
                            <option v-for="category in categories" :key="category.id" :value="category.id" :selected="category.id === form.category_id" >{{category.name}}</option>
                            
                        </select>
                        </div>
                        <div class="invalid-feedback">
                        
                        </div>
                    </div>

                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" v-on:change="onChange" id="validatedCustomFile" accept="image/*"  required>
                        <label class="custom-file-label"  for="validatedCustomFile">Choose Cover Image ...</label>
                        <div class="invalid-feedback"></div>
                    </div>`
                    
                    
                
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-primary btn-block" >Update Product</button>
            </div>
            </form>
        </div>
</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'
import urls from '../services/apiURLs.js'

    export default {
        data(){
                return{                    
                    categories:[],
                    form:{
                        name:'',
                        price:0,
                        category_id:1,
                        image:null
                    }
                }    
                
            },
        mounted() {
            console.log('Component mounted.');
            const that = this;
            axios.get(`${urls.getCategoriesURL}`).then(categoryResponse => {
                this.categories = categoryResponse.data;
                console.log(this.categories)
                axios.get(`${urls.getProductURL}${that.$route.params.productId}`).then(productResponse => {
                    this.form.name = productResponse.data.name;
                    this.form.price = productResponse.data.price;
                    this.form.category_id = productResponse.data.category_id;
                    //  this.products = this.products.map((product) =>{
                    //     product.category_id= this.categories.filter((cata) => parseInt(cata.id) == parseInt(product.category_id))[0] ; 
                    //     console.log(product);
                    //     return product
                    //     });
                    // })
                    console.log(this.form)
                })
            })
        },
        methods:{
            onChange(e) {
                this.form.image = e.target.files[0];
                console.log(this.form);
            },
            // createImage(file) {
            //     let reader = new FileReader();
            //     let vm = this;
            //     reader.onload = (e) => {
            //         vm.form.image = e.target.result;
            //     };
            //     reader.readAsDataURL(file);
            // },
            onSubmit(e) {
                e.preventDefault();
                const existingObj = this;

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }            
                const formData = new FormData()
                formData.append('image', this.form.image)
                formData.append('name', this.form.name)
                formData.append('price', this.form.price)
                formData.append('category_id', this.form.category_id)
                console.log([ ...formData ]);
                // axios.put(`${urls.putProductURL}${existingObj.$route.params.productId}`, formData,config).then(function (res) {
                //         existingObj.success = res.data.success;
                //         // existingObj.$router.push({ name: 'allProducts' })
                //         console.log(res);
                //     })
                //     .catch(function (err) {
                //         existingObj.output = err;
                //     });
            }  
        }
        
    }
</script>

<style scoped>

</style>