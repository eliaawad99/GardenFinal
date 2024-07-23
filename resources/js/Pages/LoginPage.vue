<script setup>
import ToDoList from "@/Assets/ToDoList.vue";
import Login from "@/Components/Login.vue";

</script>

<template>
    <div
        class="bg-cover h-screen overflow-hidden bg-[url('/images/Background.png')]"
    >
        <div class="grid grid-cols-2">
            <div class="h-screen flex justify-center relative bg-no-repeat bg-cover bg-right bg-[url('/images/Subtract.png')] mr-16">
                <ToDoList class="mr-36 mt-40"  />
            </div>

            <div class="flex justify-center items-center">
                <Login/>
            </div>
        </div>
    </div>
</template>
