<template>


    
    <div v-if="showList">
        <ul role="list" class="divide-y divide-gray-100">
          <div v-for="category in categories" :key="category.id" class="list">
          <li class="flex justify-between gap-x-6">
      <div class="flex min-w-0 gap-x-4">
        <div class="min-w-0 flex-auto">
          <p class="title font-semibold leading-6 text-gray-900">   {{ category.title }} </p>
          <p class="mt-1 text-xs leading-5 text-gray-500">Created on: {{category.created_at}}</p>
        
        </div>
      </div>
  
      <div class=" flex flex-col items-end">
         <div style="display: flex; cursor: pointer;margin-top: 22px;">
          <img class="edit-img" style="margin-right: 5px;"  @click="viewCategory(category.id)" width="22px" src="../assets/edit.png" alt="">
          <img class="delete-img" width="22px" @click="deleteCategory(category.id)" src="../assets/delete.png" alt="">
         </div>
      </div>
    </li>
            </div>
  
   
    
  </ul>
      </div>
     
  
      <div style="padding: 50px; text-align: center; font-size: 32px; font-weight: bolder;" v-else>
       <h2>No Category yet!</h2>
      
    
   
        <div class="text-center">
        
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <button @click="addCategory" style="box-shadow: 0 4px 8px rgba(0,0,0,0.2);background-image: linear-gradient(to bottom right,#2193b0 , #6dd5ed);padding: 10px 20px;border-radius: 5px;color: #fff;font-size: 13px;font-weight: 700;">Add Category</button>
        
          </div>
       
        </div>
    
  
     </div>
</template>

<script>
import gql from 'graphql-tag';
  
   export default {
    name: 'CategoryView',
    data(){
    return {
     categories:[],
     showList:true,
     user_id: null,
    }
    },
    methods:{
    viewCategory(id){
  
  this.$router.push({
    name:"updateCategory",
    params:{id:id}
  })
  },
  deleteCategory(id){
    this.$apollo.mutate({
             // Query
             mutation:  gql`
             mutation($id: ID!, $user_id: String!){
              deleteCategory(id: $id, user_id: $user_id) {
               id
             }
            }`,
             // Parameters
             variables: {
              id: id,
              user_id: this.user_id
             }
             }).then((res)=>{
                 if (res.data.deleteCategory.id) {
                  //removes category from the category array
                 this.categories = this.categories.filter((category)=> category.id != res.data.deleteCategory.id)
                 }

                if (this.categories.length == 0) {
                  //don't show category list if the category array is empty
                this.showList = false;
              }
            
                 
               }).catch((err)=>{
               console.log(err.graphQLErrors)
               })


  },
  fetchCategories(){
    
    this.$apollo.query({
             // Query
             query:  gql`
             {
              authUser {
                  name
                  categories{
                    id
                    title
                    created_at
                  }
                  
                }
              }`,
  
             }).then((res)=>{
               
              this.categories = res.data.authUser.categories;
               //if user does not have categories
              if (this.categories.length == 0) {
                this.showList = false;
              }
              else{
                this.showList = true; 
              }
             
                
                
               }).catch((err)=>{
               console.log(err.graphQLErrors)
               })
  
  },
 
 
   },

 mounted(){
  
  this.fetchCategories()
  this.user_id = localStorage.getItem('id');
  
  
 }
   
  }

  </script>


<style>
.list{
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    padding: 10px 15px;
    border-radius: 7px;
    margin-bottom: 15px;
}
@media screen and (max-width: 550px) {
  
  .edit-img,.delete-img{
  width: 18px;
  }
  .title{
    font-size: 12px;
  }
  .text-xs{
    font-size: 10px;
  }
  }
</style>