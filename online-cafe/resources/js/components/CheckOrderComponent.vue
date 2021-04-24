<template>
{{id}}
</template>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000";

export default {
  data() {
    return {
        id:this.$route.params.id
      
    };
  },
  
  methods: {
    
  },
  created() {
    
  },
};
</script>