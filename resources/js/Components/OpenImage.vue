<script setup>
const props = defineProps({
    image: String
});

const emit = defineEmits(['close']);

const closeImage = () => {
    emit('close');
}
</script>

<template>
    <div class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-10">
        <div
            class="w-[1000px] h-[700px] py-5 px-7 bg-custom-yellow skew-y-1 rounded-tl-[25px] rounded-tr-[40px] rounded-br-[15px] rounded-bl-[30px] relative">
            <img src="/images/CloseIcon.svg" @click="closeImage" class="absolute top-12 left-12 custom-cursor z-10">
            <img :src="props.image" class="h-full w-full object-cover rounded-tl-[25px] rounded-tr-[40px] rounded-br-[15px] rounded-bl-[30px] relative"/>
        </div>
    </div>
</template>
