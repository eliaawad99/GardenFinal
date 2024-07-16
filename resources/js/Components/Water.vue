<script setup>
import JoinComment from "@/Assets/JoinComment.vue";
import { ref } from "vue";
import WaterIcon from "../Assets/WaterIcon.vue";

const props = defineProps({
    watering: Number,
});

const isWatered = (index) => {
    return index <= props.watering;
};


const isHover = ref(false);

const handleMouseEnter = () => {
    isHover.value = true;
};

const handleMouseLeave = () => {
    isHover.value = false;
};
</script>

<template>
    <div
        class="flex justify-center relative gap-1"
        @mouseenter="handleMouseEnter"
        @mouseleave="handleMouseLeave"
    >
        <JoinComment
            class="absolute bottom-5"
            v-if="isHover"
            :watering="watering"
        />
        <WaterIcon
            v-for="n in 5"
            :key="n"
            :color="isWatered(n) ? 'green' : '#DED295'"
        />
    </div>
</template>
