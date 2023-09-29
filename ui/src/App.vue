<script setup>
import { RouterView } from 'vue-router'
</script>

<template>
   <RouterView />
</template>

<style>
input,textarea,select{
  padding: 10px !important;
}

*{
  font-family: 'Poppins', sans-serif !important;
}

form.container{
  width: 60%;
  box-shadow: 0 0 8px rgba(0,0,0,0.2); 
  padding-top: 30px;
  padding-bottom: 30px; 
  margin-bottom: 40px;
}

@media screen and (max-width: 1024px) {
  form.container{
  width: 70%;
}
}
@media screen and (max-width: 768px) {
  form.container{
  width: 80%;
}
}
@media screen and (max-width: 600px) {
  form.container{
  width: 90%;
}
}
</style>
