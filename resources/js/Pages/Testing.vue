<script setup>
import Subtract from '@/Assets/Subtract.vue';
import ToDoList from '@/Assets/ToDoList.vue';
import Login from '@/Pages/Auth/Login.vue';
import Register from '@/Pages/Auth/Register.vue';
import { ref } from 'vue';

const isRegistering = ref(false);

const switchComponent = () => {
  isRegistering.value = !isRegistering.value;
}
</script>

<template>
  <img class="absolute object-center object-cover h-screen w-full" src="/images/background.png" alt="">
  <div class="grid grid-cols-2">
    <div class="z-10 object-cover h-screen">
      <Subtract class="h-screen"></Subtract>
      <ToDoList class="absolute left-28 top-32 z-20"></ToDoList>
    </div>

    <div class="flex justify-center items-center">
      <Login v-if="!isRegistering" @switch-component="switchComponent" class="absolute z-30"></Login>
      <Register v-else @switch-component="switchComponent" class="absolute z-30"></Register>
    </div>
  </div>
</template>