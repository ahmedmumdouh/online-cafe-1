<template>
    <div class="container">
       All Products
      


         <router-link class="btn btn-success mb-2 float-right" :to="{name: 'addProduct'}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>
    </router-link>
   
    <table class="table text-center table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Image</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            <tr  v-for="product in products" :key="product.id" >
                <td style="vertical-align: middle;">{{product.name}}</td>
                <td>{{product.price}}</td>
                <td>{{product.category_id.name}}</td>
                <td style="width:25%"><img :src="imageServerURL+product.image" style="width:25% ;" :alt="product.name"></td>
                <td>
                    <button class="btn btn-info" @click="visable(product.id)">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                    </button>
                    <router-link class="btn btn-success " :to="{name: 'updateProduct', params: { productId: product.id }}">
                      
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </router-link>
                    <button class="btn btn-danger" @click="remove(product.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

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
                    products:[],
                    categories:[],
                    imageServerURL:urls.imageServerURL,
                }    
                
            },
        mounted() {
            console.log('Component mounted.');
            axios.get(`${urls.getProductsURL}`).then(productResponse => {
            this.products = productResponse.data;

            //  this.products = this.products.map((product) =>{
            //     product.category_id= this.categories.filter((cata) => parseInt(cata.id) == parseInt(product.category_id))[0] ; 
            //     console.log(product);
            //     return product
            //     });
            })
        },
        methods:{
            remove(id){
                console.log(this.products);
                
                axios.delete(`${urls.deleteProductURL}${id}`).then(productResponse => {
                        let i = this.products.findIndex(item => item.id === id );
                        console.log(i);
                        this.products.splice(i,1);
                        console.log(productResponse);
                        console.log(this.products);
                } )          
            },
            visable(id){

            }
        
        }
        
    }
</script>



<style scoped>
th, td {
    text-align: center;
    vertical-align: middle;
}
</style>