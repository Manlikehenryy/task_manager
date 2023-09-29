import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import CategoryView from '../views/CategoryView.vue'
import AddCategoryView from '../views/AddCategoryView.vue'
import AddTaskView from '../views/AddTaskView.vue'
import UpdateTaskView from '../views/UpdateTaskView.vue'
import UpdateCategoryView from '../views/UpdateCategoryView.vue'


Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    // beforeEnter:()=>{
    //   console.log('dd')
    //   return '/'
    // }
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path:'/login',
    name: 'login',
    component: LoginView
  },
  {
    path:'/register',
    name: 'register',
    component: RegisterView
  },
  {
    path:'/add-category',
    name: 'addCategory',
    component: AddCategoryView
  },
  {
    path:'/add-task',
    name: 'addTask',
    component: AddTaskView
  },
  {
    path:'/update-task/:id',
    name: 'updateTask',
    component: UpdateTaskView
  },
  {
    path:'/update-category/:id',
    name: 'updateCategory',
    component: UpdateCategoryView
  },
  {
    path:'/view-category',
    name: 'viewCategory',
    component: CategoryView
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})




export default router
