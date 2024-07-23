<script setup>
const props = defineProps({
    notes: String
});

const emit = defineEmits(['close']);

const closeNote = () => {
    emit('close');
};
</script>

<template>
    <div class="fixed z-10 inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-custom-yellow skew-y-1 rounded-tl-[25px] rounded-tr-[40px] rounded-br-[15px] rounded-bl-[30px] relative p-20 max-w-sm">
            <img src="/images/CloseIcon.svg" @click="closeNote" class="absolute top-4 left-4 custom-cursor z-10">
            <div class="max-w-[500px] break-words">{{ props.notes }}</div>
        </div>
    </div>
</template>
