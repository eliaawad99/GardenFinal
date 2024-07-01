<script setup>
import SunIcon from '../Assets/SunIcon.vue';

const props = defineProps({
    sunlight : Number
});

const isSun = (index) => {
    return index < props.sunlight;
};
</script>

<template>
    <div class="flex justify-center">
        <SunIcon v-for="n in 5" :key="n" :color="isSun(n - 1) ? 'green' : '#DED295'"/>
    </div>
</template>