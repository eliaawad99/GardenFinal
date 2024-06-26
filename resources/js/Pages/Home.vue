<script setup>
import NoDataImage from '@/Components/NoDataImage.vue';
import Popup from '@/Components/Popup.vue';
import SideBar from '@/Components/SideBar.vue';
import Table from '@/Components/Table.vue';
import { ref } from 'vue';

defineProps({
    plants: Array,
});

const isPopupVisible = ref(false);

const togglePopup = () => {
    isPopupVisible.value = !isPopupVisible.value;
};
</script>

<template>
    <div class="flex h-screen w-screen bg-custom-yellow font-irish-grover">
        <div class="h-screen w-[14%]">
            <SideBar></SideBar>
        </div>
        <div class="w-[83%] h-[80.7%]">
            <div class="flex justify-between pt-11 pb-4">
                <p class="text-custom-green text-2xl">Hi there, {{ $page.props.auth.user.name }}!</p>
                <p>search bar</p>
            </div>
            <Table :plants="plants"></Table>
            <NoDataImage></NoDataImage>
        </div>
        <div class="fixed bottom-0 right-0 mb-6 mr-6">
            <img class="cursor-pointer" src="/images/AddButton.svg" alt="Add Button" @click="togglePopup">
        </div>
        <Popup v-if="isPopupVisible" @close="togglePopup" />
    </div>
</template>
