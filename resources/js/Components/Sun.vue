<script setup>
import JoinComment from '@/Assets/JoinComment.vue';
import { ref } from 'vue';
import SunIcon from '../Assets/SunIcon.vue';

const props = defineProps({
    sunlight: Number
});

const isSun = (index) => {
    return index <= props.sunlight;
};

const isHovered = ref(false);

const handleMouseEnter = () => {
    isHovered.value = true;
};

const handleMouseLeave = () => {
    isHovered.value = false;
};
</script>

<template>
    <div 
        class="flex justify-center relative gap-1" 
        @mouseenter="handleMouseEnter" 
        @mouseleave="handleMouseLeave"
    >
        <JoinComment 
            v-if="isHovered" 
            class="absolute bottom-5" 
            :sunlight="sunlight" 
        />
        <SunIcon 
            v-for="n in 5" 
            :key="n" 
            :color="isSun(n) ? 'green' : '#DED295'"
        />
    </div>
</template>
