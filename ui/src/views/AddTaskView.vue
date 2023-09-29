
<template>
    <div>
     <Navbar/>
    <form @submit.prevent="submitDetails()" v-if="showForm" class="container">
     <div class="space-y-12">
       <div class="border-b border-gray-900/10 pb-12">
         <h2 class="text-base font-semibold leading-7 text-gray-900">Add Task</h2>
         <!-- <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p> -->
   
         <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
   
           <div class="col-span-full">
             <label for="skills" class="block text-sm font-medium leading-6 text-gray-900">Select Category</label>
             <div class="mt-2">
                <select required v-model="category_id" name="" id="">
                 <option v-for="category in categories" :key="category.id" :value="category.id">{{category.title}}</option>
                </select> 
            </div>
           </div>

           <div class="col-span-full">
             <label for="skills" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
             <div class="mt-2">
               <input required type="text" placeholder="e.g Go to work" v-model="title" name="title" id="title" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
             </div>
           </div>
           <div class="col-span-full">
             <label for="skills" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
             <div class="mt-2">
                <textarea required  cols="30" rows="5" autocomplete="given-name" v-model="description"   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="" id=""></textarea>
             </div>
           </div>

           <div class="col-span-full">
             <label for="skills" class="block text-sm font-medium leading-6 text-gray-900">Due Date</label>
             <div class="mt-2">
               <input required type="date" v-model="due_date" name="due_date" id="due_date" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
             </div>
           </div>
   
         </div>
       </div>
     </div>
   
     <div class="mt-6 flex items-center justify-end gap-x-6">
       <button type="submit" style="background-image: linear-gradient(to bottom right,#2193b0 , #6dd5ed);box-shadow: 0 4px 8px rgba(0,0,0,0.2);" class="rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Add Task</button>
     </div>
   </form>
   
   <div style="padding: 100px; text-align: center; font-size: 32px; font-weight: bolder;" v-if="!showForm">
     <h2>Added successfully!!</h2>
     <RouterLink to="/">
  
 
      <div class="text-center">
      
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <div style="box-shadow: 0 4px 8px rgba(0,0,0,0.2);background-image: linear-gradient(to bottom right,#2193b0 , #6dd5ed);" class="rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 ">Back to Home</div>
      
        </div>
     
      </div>
  
 </RouterLink>
   </div>
    </div>
   </template>
   
   <script>
 import { RouterLink } from 'vue-router'
 import Navbar from '../components/Navbar.vue';
 import gql from 'graphql-tag';
   
    export default {
     name: 'AddTaskView',
     data(){
     return {
      showForm: true,
       
       title : null,
       user_id: null,
       category_id: null,
       description: null,
       due_date: null,
       status: "Not Started",
       categories:null
     }
     },
     methods:{
       async submitDetails(){
       // e.preventDefault();
       this.user_id = localStorage.getItem('id');
 
       this.$apollo.mutate({
              // Query
              mutation:  gql`
              mutation($title: String!,$user_id:String!,$category_id: ID!,$description:String!,$due_date: Date!,$status:String!){
              createTask(title: $title,user_id:$user_id,category_id: $category_id,description:$description,due_date: $due_date,status:$status){
              id
              title
              }
              }`,
              // Parameters
              variables: {
               title: this.title,
               user_id: this.user_id,
               category_id: this.category_id,
               description: this.description,
               due_date: this.due_date,
               status: this.status
              }
              }).then((res)=>{
               this.showForm = false;
                  console.log(res)
                }).catch((err)=>{
                console.log(err.graphQLErrors)
                })
       }
      
     },
     components:{
         RouterLink,
         Navbar
     },
  mounted(){
  
  this.$apollo.query({
             // Query
             query:  gql`
             {
              authUser {
                  name
                  categories{
                    id
                    title
                  }
                }
              }`,
  
             }).then((res)=>{
             
              this.categories = res.data.authUser.categories;
              this.category_id = this.categories[0].id
               }).catch((err)=>{
               console.log(err.graphQLErrors)
               })
  
 }
    
   }
   </script>
   