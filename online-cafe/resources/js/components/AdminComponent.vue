<template>
    <div class="class container">
<div class="raw ">
<div class="class col-12">
   <!-- <h1>table commponent </h1>  -->
   <!--put table component here-->
   
   <allusercomponent />

</div><!--end of col class-->
</div> <!--end of class row-->
</div> <!--end of class container-->

     



</template>

<script>
import allusercomponent from './allusercomponent.vue'
import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'

    export default {
        // mounted() {
        //     console.log('Component mounted.');
        //     axios.get('/api/categories').then(response => {
        //         console.log(response.data)
        //     })
        // },

        data()
    {
          return{

          }
             }
   
,
components:{
   allusercomponent

           },
 methods:{

 }




        
    }
</script>
