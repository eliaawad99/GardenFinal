<script setup>
import ButtonContainer from '@/Assets/ButtonContainer.vue';
import TreeBackground from '@/Assets/TreeBackground.vue';

const emit = defineEmits(['open']);

const openPoppup = () => {
    emit('open')
};


const buttonText = "Add a Plant, Child";
</script>

<template>
    <div class="flex flex-col justify-center items-center h-[70vh]">
        <div>
            <TreeBackground class="absolute mt-10"></TreeBackground>
            <img class="relative" src="/images/Tree.svg" />
        </div>
        <p class="pt-16 w-80 text-2xl text-center text-header-background">You don't have any Plants in your Garden.</p>
        <ButtonContainer @click="openPoppup" :buttonText="buttonText"></ButtonContainer>
    </div>
</template>