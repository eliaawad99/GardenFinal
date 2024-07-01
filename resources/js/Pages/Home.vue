<script setup>
import NoDataImage from '@/Components/NoDataImage.vue';
import Popup from '@/Components/Popup.vue';
import SideBar from '@/Components/SideBar.vue';
import Table from '@/Components/Table.vue';
import { computed, ref } from 'vue';

const props = defineProps({
    plants: Object,
});

const searchQuery = ref('');

const filteredPlants = computed(() => {
    if (!searchQuery.value) {
        return props.plants.data;
    }
    return props.plants.data.filter(plant =>
        plant.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});


const isData = computed ( () => props.plants.data.length ===0);


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
        <div class="w-[83%] h-[100%]">
            <div class="flex justify-between pt-8 pb-4">
                <p class="text-custom-green text-2xl">Hi there, {{ $page.props.auth.user.name }}!</p>
                <input
                    type="text"
                    placeholder="Search plants..."
                    v-model="searchQuery"
                    class="border border-gray-300 rounded px-4 py-2"
                />
            </div>
            <Table :plants="plants" :plant="{ data: filteredPlants }"></Table>
            <div class="flex items-center justify-center">
            <NoDataImage v-if="isData"></NoDataImage>
        </div>
        </div>
        <div class="fixed bottom-0 right-0 mb-6 mr-6">
            <img class="hover:Custom-Cursor" src="/images/AddButton.svg" alt="Add Button" @click="togglePopup">
        </div>
        <Popup v-if="isPopupVisible" @close="togglePopup" />
    </div>
</template>
