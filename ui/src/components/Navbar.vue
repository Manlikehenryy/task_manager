

<template>
  <nav style="margin-bottom:40px;box-shadow: 0 0 8px rgba(0,0,0,0.2);" >
 <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
   <div class="relative flex h-16 items-center justify-between">
     <div @click="toggleMenu" class="absolute inset-y-0 left-0 flex items-center sm:hidden">
       <!-- Mobile menu button-->
       <button type="button" class="inline-flex items-center justify-center rounded-md p-2  hover:bg-gray-700  focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
         <span class="sr-only">Open main menu</span>
         <!--
           Icon when menu is closed.

           Menu open: "hidden", Menu closed: "block"
         -->
         <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
           <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
         </svg>
         <!--
           Icon when menu is open.

           Menu open: "block", Menu closed: "hidden"
         -->
         <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
           <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
         </svg>
       </button>
     </div>
     <div style="color: black !important;"  class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
       <div class="flex flex-shrink-0 items-center">
        <RouterLink to="/">
         <div class=" rounded-md px-3 py-2 text-sm font-medium" style="font-weight:bolder" >My Tasks</div>
        </RouterLink>
       </div>
       <div style="width: 100%;" class="hidden sm:ml-6 sm:block">
       <div style="display: flex;width: 100%;align-items: center;">
        <div class="nav-title flex space-x-4">
        
          <RouterLink to="/view-category">
           <div style="font-weight: 700 !important;" class="rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Category</div>
           </RouterLink>

        
    
<!-- 
         <RouterLink to="#">
           <div class="hover:bg-gray-700 hover:text-white text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">About</div>
           </RouterLink>

           <RouterLink to="#">
           <div class="hover:bg-gray-700 hover:text-white text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Contact</div>
           </RouterLink>
         -->
         </div>

         <div style="width:60%"  class="flex pt-4 mb-8 relative">
      <input
        type="text"
        v-model="searchQuery"
        @input="getSearchResults"
        placeholder="Search for a task title or description"
        style="margin-top: 13px;background-color: #f2f2f2; border-radius: 7px; font-size: 14px;"
        class="py-2 px-1 w-full"
      />

      <ul style="color: black;background-color: #fff; border-radius: 7px;padding: 10px;"
        class="absolute w-full shadow-md py-2 px-1 top-[66px]"
        v-if="searchResults"
      >
        <p class="py-2" v-if="searchError">
          Sorry, something went wrong, please try again.
        </p>
        <p
          class="py-2"
          v-if="!searchError && searchResults.length === 0"
        >
          No results match your query, try a different term.
        </p>
        <template v-else>
          <li 
            v-for="searchResult in searchResults"
            :key="searchResult.id"
            class="py-2 cursor-pointer"
            @click="viewTask(searchResult.id)"
          >
            {{ searchResult.title }}
          </li>
        </template>
      </ul>
    </div>
       </div>

       </div>
     </div>
     <div style="color: #a19e9e;" class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
       <!-- <button type="button" class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
         <span class="sr-only">View notifications</span>
         <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
           <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
         </svg>
       </button> -->
       <div v-if="isLoggedOn" style="font-weight: 700 !important;" class="rounded-md px-3 py-2 text-sm font-medium">Hi {{name}}</div>


       <!-- Profile dropdown -->
       <div @click="toggleDropdown" class="relative ml-3">
         <div>
           <button type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
             <span class="sr-only">Open user menu</span>
             <img class="h-8 w-8 rounded-full" src="../assets/icons8-user-5.png" alt="">
           </button>
         </div>

         <!--
           Dropdown menu, show/hide based on menu state.

           Entering: "transition ease-out duration-100"
             From: "transform opacity-0 scale-95"
             To: "transform opacity-100 scale-100"
           Leaving: "transition ease-in duration-75"
             From: "transform opacity-100 scale-100"
             To: "transform opacity-0 scale-95"
         -->
         <div v-if="showDropdown" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
           <!-- Active: "bg-gray-100", Not Active: "" -->
           <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a> -->
           <RouterLink v-if="!isLoggedOn" to="/register">
             <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Sign up</div>
           </RouterLink>
           <RouterLink v-if="!isLoggedOn" to="/login">
             <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Sign in</div>
           </RouterLink>
           <RouterLink v-if="isLoggedOn" to="">
             <div @click="logout" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Sign out</div>
           </RouterLink>
   
         </div>
       </div>
     </div>
   </div>
 </div>

 <!-- Mobile menu, show/hide based on menu state. -->
 <div v-if="showMobileMenu" class="sm:hidden" id="mobile-menu">
   <div class="space-y-1 px-2 pb-3 pt-2">
     <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
     <RouterLink to="/">
           <div class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</div>
           </RouterLink>
     
     <RouterLink to="/view-category">
           <div class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Category</div>
           </RouterLink>
    
   </div>
 </div>
</nav>



</template>

<style>
.nav-title{
  width:20%;
  color: #a19e9e;
}
@media screen and (max-width: 800px) {
  .nav-title{
    width: 30%;
  }
}
</style>




<script>
import {RouterLink} from 'vue-router'
import { onLogout } from '@/vue-apollo';
import gql from 'graphql-tag';

export default {
 name: 'Navbar',
 data(){
 return {
   showMobileMenu : false,
   showDropdown : false,
   showDropdown2: false,
   token:null,
   isLoggedOn:false,
   name:null,
   queryTimeout:null,
   searchQuery: null,
   searchError:null,
   searchResults:null,
   user_id: null
 }
 },
 mounted(){
  this.checkIfUserIsLoggedOn();
 }
 ,
 methods:{
  checkIfUserIsLoggedOn()
  {
  this.token = localStorage.getItem('apollo-token'); 
   this.user_id = localStorage.getItem('id');

   if (this.token) {
     this.isLoggedOn = true;
     this.name = localStorage.getItem('name').split(" ")[0]; 
   } else {
     this.isLoggedOn = false;
     console.log('to',this.$route.path)
     this.$router.push('/login')
   }
 },
  toggleMenu(){
     this.showMobileMenu = !this.showMobileMenu
   },
   toggleDropdown(){
     this.showDropdown = !this.showDropdown
   },
   toggleDropdown2(){
     this.showDropdown2 = !this.showDropdown2
   },
    logout(){
    onLogout(this.$apollo.provider.defaultClient)
    localStorage.removeItem('name')
    localStorage.removeItem('id')
    this.checkIfUserIsLoggedOn();
   },
    getSearchResults(){
  clearTimeout(this.queryTimeout);
  
  
    this.queryTimeout = setTimeout(async ()=>{
    if (this.searchQuery != ""&&this.user_id != "") {
      
      this.$apollo.query({
             // Query
             query:  gql`
             query($keyword: String!, $user_id: String!){
              getTask(keyword: $keyword, user_id: $user_id) {
                    id
                    title         
                }
              }`,
             // Parameters
             variables: {
                keyword: this.searchQuery,
                user_id: this.user_id
             }
             }).then((res)=>{
              this.searchResults = res.data.getTask;
              return
               }).catch((err)=>{
                this.searchError = true
               console.log(err.graphQLErrors)
               return
               })
      
    }
    this.searchResults = null;
  },300)
 
   
  
},
viewTask(id){
  
this.$router.push({
  name:"updateTask",
  params:{id:id}
}).catch(()=>{
  //solves problem of redirecting to same route
  this.searchQuery =  null;
  this.searchResults = null;
  alert('you are already viewing a task')
})
}
 },
 components:{RouterLink}
}
</script>


