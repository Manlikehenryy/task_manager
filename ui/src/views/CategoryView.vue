<template>
    <div>
      <Navbar/>
      
  
      
  
    <div class="home-container">
     <CategoryList></CategoryList>  
    </div>
  
  
    </div>
  </template>

  <style>
.home-container{
    width: 52%;
    display: flex;
    flex-direction: column;
    margin: auto;
}

@media screen and (max-width: 1024px) {
  .home-container{
  width: 70%;
}
}
@media screen and (max-width: 768px) {
  .home-container{
  width: 80%;
}
}
@media screen and (max-width: 600px) {
  .home-container{
  width: 90%;
}
}

</style>
  

<script>
import Navbar from '../components/Navbar.vue';
import CategoryList from '../components/CategoryList.vue';  

   export default {
    name: 'HomeView',
   
    components:{
        Navbar,
        CategoryList
    }
   
  }

  </script>