<script setup>
import Subtract from "@/Assets/Subtract.vue";
import ToDoList from "@/Assets/ToDoList.vue";
import Login from "@/Components/Login.vue";

</script>

<template>
    <div
        class="bg-cover h-screen overflow-hidden"
        style="background-image: url('/images/Background.png')"
    >
        <div class="grid grid-cols-2">
            <div class="h-screen">
                <Subtract class="min-h-screen" />
                <ToDoList class="absolute left-28 top-32" />
            </div>

            <div class="flex justify-center items-center">
                <Login/>
            </div>
        </div>
    </div>
</template>
