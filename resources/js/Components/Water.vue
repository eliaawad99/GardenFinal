<script setup>
import WaterIcon from '../Assets/WaterIcon.vue';


const props = defineProps({
    watering: Number
});

const isWatered = (index) => {
    return index < props.watering;
};
</script>

<template>
    <div class="flex justify-center">
        <WaterIcon v-for="n in 5" :key="n" :color="isWatered(n - 1) ? 'green' : '#DED295'" />
    </div>
</template>
