<template>
   <div>
    <div class="box-container">
      <div style="box-shadow: 0 3px 8px rgba(0,0,0,0.2);background-image: linear-gradient(to bottom right,#de6262 , #ffb88c);width: 200px;height: 120px;border-radius: 12px;">
       <div>
        <div style="margin: 21px 15px 15px 15px;font-size: 14px;">
          <div>Tasks <br> Not Started</div>
        </div>

        <div style="margin: 15px;">{{not_started}}</div>
       </div>
      </div> 

      <div style="box-shadow: 0 3px 8px rgba(0,0,0,0.2);background-image: linear-gradient(to bottom right,#2193b0 , #6dd5ed);width: 200px;height: 120px;background-color: aqua;border-radius: 12px;">
       <div>
        <div style="margin: 21px 15px 15px 15px;font-size: 14px;">
          <div>Tasks <br> In Progress</div>
        </div>

        <div style="margin: 15px;">{{in_progress}}</div>
       </div>
      </div>

      <div style="box-shadow: 0 3px 8px rgba(0,0,0,0.2);background-image: linear-gradient(to bottom right,#56ab2f , #a8e063);width: 200px;height: 120px;background-color: aqua;border-radius: 12px;">
       <div>
        <div style="margin: 21px 15px 15px 15px;font-size: 14px;" class="flex">
          <div>Tasks <br> Completed</div>
        </div>

        <div style="margin: 15px;">{{completed}}</div>
       </div>
      </div>

    </div>

    <div style="display: flex;justify-content: space-between;margin-bottom: 10px;">
      <div style="font-weight: 700;padding-top: 15px;">My Tasks</div>
      <div class="button-container">
        <button @click="addCategory" class="button" style="margin-right: 10px;"><span class="plus">+</span> Add Category</button>
        <button @click="addTask" class="button"><span class="plus">+</span>Add Task</button>
      </div>
    </div>
    <div style="margin-bottom: 15px;">
     <div class="filter-container">
      <div style="display: flex;padding-top: 15px; cursor: pointer;">
        <div class="status" ref="all" @click="filterByStatus('all')" style="border-bottom: 3px solid #6dd5ed;">All</div>
      <div class="status" ref="not_started" @click="filterByStatus('Not Started')">Not Started</div>
      <div class="status" ref="in_progress" @click="filterByStatus('In Progress')">In Progress</div>
      <div class="status" ref="completed" @click="filterByStatus('Completed')">Completed</div>
      </div>

      <div style="margin-top: 4px;" >
        <select @change="filterByCategory" v-model="category_id" name="" id="">
        <option value="all">Filter by Category</option>
        <option v-for="category in categories" :key="category.id" :value="category.id">{{category.title}}</option>
      </select>
      </div>
     </div>
      <div style="width: 100%;height: 1px;background-color: #d5d3d3;"></div>
    </div>
    
  
      <div v-if="showList" >
      <ul role="list" class="divide-y divide-gray-100">
        <div v-for="task in tasks" :key="task.id" class="list">
        <li class="flex justify-between gap-x-6">
    <div class="flex min-w-0 gap-x-4">
      <div class="min-w-0 flex-auto">
        <p class="title font-semibold leading-6 text-gray-900">   {{ task.title }} </p>
        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{task.description.substring(0,40)}}</p>
        <p v-if="task.due" style="color: red; font-weight: bolder;" class="mt-1 text-xs leading-5 text-gray-500">{{task.due_date}}</p>
        <p v-else class="mt-1 text-xs leading-5 text-gray-500">{{task.due_date}}</p>
      </div>
    </div>

    <div class=" flex flex-col items-end">
      <button class="status-button" v-if="task.status=='Completed'" style="background-color: #a8e063;" >{{task.status}}</button>
      <button class="status-button" v-if="task.status=='In Progress'" style="background-color: #6dd5ed;" >{{task.status}}</button>
      <button class="status-button" v-if="task.status=='Not Started'" style="background-color: #ffb88c;" >{{task.status}}</button>

       <div style="display: flex; cursor: pointer;">
        <img class="edit-img" style="margin-right: 5px;"  @click="viewTask(task.id)" width="22px" src="../assets/edit.png" alt="">
        <img class="delete-img" width="22px" @click="deleteTask(task.id)" src="../assets/delete.png" alt="">
       </div>
    </div>
  </li>
          </div>

 
  
</ul>
    </div>


    <div style="padding: 50px; text-align: center; font-size: 32px; font-weight: bolder;" v-if="!showList">
     <h2>No Task yet!</h2>
    
  
 
      <div class="text-center">
      
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <button @click="addTask" style="box-shadow: 0 4px 8px rgba(0,0,0,0.2);background-image: linear-gradient(to bottom right,#2193b0 , #6dd5ed);padding: 10px 20px;border-radius: 5px;color: #fff;font-size: 13px;font-weight: 700;">Add Task</button>
      
        </div>
     
      </div>
  

   </div>
   </div>
</template>

<style scoped>
.list{
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    padding: 6px 15px;
    border-radius: 7px;
    margin-bottom: 15px;
}
.title{
  font-size: 0.875rem/* 14px */;
  line-height: 1.25rem/* 20px */;
}
.status{
  margin-right: 15px;
}
.filter-container{
  display: flex;
  justify-content: space-between;
  font-size: 13px;
}
.button{
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  background-image: linear-gradient(to bottom right,#2193b0 , #6dd5ed);
  padding: 10px 10px 10px 30px;
  border-radius: 20px;
  color: #fff;
  font-size: 13px;
  font-weight: 700;
  position: relative;
}
.plus{
  font-size: 22px;
  position: absolute;
  left: 11px;
  top: 4px;
}

.status-button{
  border-radius: 20px;
  color: #fff;
  font-weight: 700; 
  cursor:default;
  padding:3px 6px;
  font-size: 11px;
  margin-top: 3px;
  margin-bottom: 21px;

}

.edit-img,.delete-img{
width: 18px;
}
.home-container{
    width: 52%;
    display: flex;
    flex-direction: column;
    margin: auto;
}

.box-container{
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px; 
  color: #fff;
  font-size: 20px;
  font-weight: bolder;
}

@media screen and (max-width: 1190px) and (min-width: 1110px) {
  .home-container{
    width: 56%;
}
}

@media screen and (max-width: 1110px) and (min-width: 1030px) {
  .home-container{
    width: 60%;
}
}

@media screen and (max-width: 1030px) and (min-width: 960px) {
  .home-container{
    width: 64%;
}
}
@media screen and (max-width: 960px) and (min-width: 880px) {
  .home-container{
    width: 70%;
}
}
@media screen and (max-width: 880px) and (min-width: 768px) {
  .home-container{
    width: 80%;
}
}

@media screen and (max-width: 768px) {
  .box-container{
    display: none;
  }
  .home-container{
    width: 90%;
}
}

@media screen and (max-width: 550px) {
  
  .filter-container{
  font-size: 11px;
}
.button{
  padding: 7px 7px 7px 20px;
  border-radius: 20px;
  font-size: 11px;
}

.plus{
  font-size: 18px;
  left: 6px;
  top: 2px;
}

.button-container{
margin-top: 7px;
}


.title{
  font-size: 12px;
}
.text-xs{
  font-size: 10px;
}
}
@media screen and (max-width: 440px) {
  
  .filter-container{
  font-size: 9px;
}
.title{
  font-size: 10px;
}
.text-xs{
  font-size: 9px;
}
}

@media screen and (max-width: 380px) {
  
  .filter-container{
  font-size: 8px;
}
}
</style>


<script>
import gql from 'graphql-tag';
  
   export default {
    name: 'HomeView',
    data(){
    return {
     tasks:[],
     categories:[],
     showList:true,
     user_id: null,
     category_id: 'all',
     status: 'all',
     not_started: 0,
     in_progress: 0,
     completed: 0
    }
    },
    methods:{
      addTask(){
        //check if user has an existing category
     if(this.categories.length==0){
       alert("You don't have any category, add a category.")
     }
     else{
      this.$router.push({
        name:"addTask"
      })
     }
     
    },
    addCategory(){
      this.$router.push({
        name:"addCategory"
      })
    },
    viewTask(id){
  
  this.$router.push({
    name:"updateTask",
    params:{id:id}
  })
  },
  deleteTask(id){
    this.$apollo.mutate({
             // Query
             mutation:  gql`
             mutation($id: ID!, $user_id: String!){
              deleteTask(id: $id, user_id: $user_id) {
               id
               title
               status
             }
            }`,
             // Parameters
             variables: {
              id: id,
              user_id: this.user_id
             }
             }).then((res)=>{
                 if (res.data.deleteTask.id) {
                  //remove the task from the task array
                 this.tasks = this.tasks.filter((task)=> task.id != res.data.deleteTask.id)
                 }

                 if (res.data.deleteTask.status=="Not Started") {
                  //decrement counter if the status is not started
                  this.not_started--;
                 }
                 else if (res.data.deleteTask.status=="In Progress") {
                  //decrement counter if the status is in progress
                  this.in_progress--;
                }
                else if (res.data.deleteTask.status=="Completed") {
                  //decrement counter if the status is completed
                  this.completed--;
                }

                if (this.tasks.length == 0) {
                //do no show the task list if it is empty
                this.showList = false;
              }
            
                 
               }).catch((err)=>{
               console.log(err.graphQLErrors)
               })


  },
   fetchTasks(){
    
    this.$apollo.query({
             // Query
             query:  gql`
             {
              authUser {
                  name
                  categories{
                    id
                    title
                    tasks{
                    id
                    title         
                    description
                    due_date
                    status
                    }
                  }
                  tasks{
                    id
                    title         
                    description
                    due_date
                    status
                  }
                }
              }`,
  
             }).then((res)=>{
             
              
              this.tasks = res.data.authUser.tasks;
              this.categories = res.data.authUser.categories;
               //if user does not have tasks
              if (this.tasks.length == 0) {
                this.showList = false;
              }
              else{
              
              this.tasks.map((task)=>{
              let due_date = new Date(task.due_date);
              let today = new Date();
              let days = (due_date.getTime()- today.getTime())/(60*60*24*1000);
              
              //check what day it is
              if (days > 0 && days <= 1) {
                task.due_date = task.due_date+', '+'Tomorrow'
              }
              else if (days > -1 && days <= 0) {
                task.due_date = task.due_date+', '+'Today'
              }
              else if (days > -2 && days <= -1) {
                task.due_date = task.due_date+', '+'Yesterday'
              }

              //check if task is close to due date
                if (days <= 1) {
              
                 task.due = true;
                 return task;
                }
                else{
                  task.due = false;
                  return task;
                }
              })

                this.showList = true;
              }
                
                
               }).catch((err)=>{
               console.log(err.graphQLErrors)
               })
  
  },
  filterByStatus(status){
    this.status = status;
   if (status=="all") {
    this.getTask(status,this.category_id)
    this.$refs.completed.style = 'border-bottom: none;';
    this.$refs.in_progress.style = 'border-bottom: none;';
    this.$refs.not_started.style = 'border-bottom: none;';
    this.$refs.all.style = 'border-bottom: 3px solid #6dd5ed;';
   } else if(status=="Completed") {
    this.getTask(status,this.category_id)
    this.$refs.in_progress.style = 'border-bottom: none;';
    this.$refs.not_started.style = 'border-bottom: none;';
    this.$refs.all.style = 'border-bottom: none;';
    this.$refs.completed.style = 'border-bottom: 3px solid #6dd5ed;';
   }
   else if(status=="In Progress") {
    this.getTask(status,this.category_id)
    this.$refs.not_started.style = 'border-bottom: none;';
    this.$refs.all.style = 'border-bottom: none;';
    this.$refs.completed.style = 'border-bottom: none;';
    this.$refs.in_progress.style = 'border-bottom: 3px solid #6dd5ed;';
  }
  else if(status=="Not Started") {
    this.getTask(status,this.category_id)
    this.$refs.all.style = 'border-bottom: none;';
    this.$refs.completed.style = 'border-bottom: none;';
    this.$refs.in_progress.style = 'border-bottom: none;';
    this.$refs.not_started.style = 'border-bottom: 3px solid #6dd5ed;';
  }
  },
  getTask(status,category_id){
    this.$apollo.query({
             // Query
             query:  gql`
             query($status: String!, $user_id: String!,$category_id: ID!){
              filterTask(status: $status, user_id: $user_id, category_id: $category_id) {
                    id
                    title  
                    description
                    due_date
                    status       
                }
              }`,
             // Parameters
             variables: {
                status: status,
                user_id: this.user_id,
                category_id: category_id
             }
             }).then((res)=>{
              this.tasks = res.data.filterTask;
              if (this.tasks.length == 0) {
                this.showList = false;
              }
              else{
              this.tasks.map((task)=>{
              let due_date = new Date(task.due_date);
              let today = new Date();
              let days = (due_date.getTime()- today.getTime())/(60*60*24*1000);
             
              //check what day it is
              if (days > 0 && days <= 1) {
                task.due_date = task.due_date+', '+'Tomorrow'
              }
              else if (days > -1 && days <= 0) {
                task.due_date = task.due_date+', '+'Today'
              }
              else if (days > -2 && days <= -1) {
                task.due_date = task.due_date+', '+'Yesterday'
              }

                //check if task is close to due date
                if (days <= 1) {
                  
                 task.due = true;
                 return task;
                }
                else{
                  task.due = false;
                  return task;
                }
              })
                this.showList = true;
              }
              return
               }).catch((err)=>{
                this.searchError = true
               console.log(err.graphQLErrors)
               return
               })
  },
  filterByCategory(){
    this.getTask(this.status,this.category_id)
  },
  countTask(){
    this.$apollo.query({
             // Query
             query:  gql`
             query($user_id: String!){
              countTask(user_id: $user_id) {
                not_started
                in_progress
                completed    
                }
              }`,
             // Parameters
             variables: {
                user_id: this.user_id,
             }
             }).then((res)=>{
              //counts task based on status
              this.not_started = res.data.countTask.not_started;
              this.in_progress = res.data.countTask.in_progress;
              this.completed = res.data.countTask.completed;
              }).catch((err)=>{
                this.searchError = true
               console.log(err.graphQLErrors)
               return
               })
    
  }
   },

 mounted(){
  
  this.fetchTasks()
  this.user_id = localStorage.getItem('id');
  this.countTask()
  
 }
   
  }

  </script>
