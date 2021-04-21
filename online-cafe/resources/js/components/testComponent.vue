<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example compo
                       
                        <h3>test </h3>
    
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials =true
axios.defaults.baseURL = 'http://localhost:8000'

    export default {
        mounted() {
            console.log('Component mounted.');
            axios.get('/api/categories').then(response => {
                console.log(response.data)
            })
        },
        
    }
</script>
