<script setup>
const props = defineProps({
    type:String,
});


</script>


<template>

    <div
        class="flex justify-between items-center px-6 bg-input-color skew-x-12 w-[400px] h-[48px] mt-6 border-0 rounded">
        <p class="text-custom-gold">{{ type }}</p>
        <div class="flex">
         <slot/>
        </div>
    </div>


</template>