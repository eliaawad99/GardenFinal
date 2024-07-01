<script setup>
import ArrowIcon from '@/Assets/ArrowIcon.vue';
import { inject, ref } from 'vue';

const isArrowClicked = inject('isArrowClicked');

const props = defineProps({
    childName:{
        type: String,
    }
});

</script>


<template>
    <div class="flex items-center justify-center cursor-pointer">
                            <span>{{childName}}</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.name }"
                                :color="isArrowClicked.name ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
</template>