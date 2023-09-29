<template>
  <div>
    <Navbar/>

  <div class="home-container">
   

  <TaskList></TaskList>
   
  </div>


  </div>
</template>

 
<script>
// import { RouterLink } from 'vue-router'
import Navbar from '../components/Navbar.vue';

import TaskList from '@/components/TaskList.vue';
  
   export default {
    name: 'HomeView',
   
    components:{
        // RouterLink,
        Navbar,
        TaskList
    }
   
  }

  </script>
