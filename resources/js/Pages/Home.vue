<script setup>
import AddButton from '@/Assets/AddButton.vue';
import SearchIcon from "@/Assets/SearchIcon.vue";
import NoDataImage from "@/Components/NoDataImage.vue";
import Pagination from "@/Components/Pagination.vue";
import Popup from "@/Components/Popup.vue";
import SearchInput from "@/Components/SearchInput.vue";
import SideBar from "@/Components/SideBar.vue";
import Table from "@/Components/Table.vue";
import { router } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps({
    plants: Object,
});

const uri = window.location.search.substring(1);
const params = new URLSearchParams(uri);


const isNoLink = computed (() => props.plants.data.length === 0);

const searchTerm = ref(params.get("searchTest") || "");
const currentSortKey = ref(params.get('sort_by') || null);
const currentSortOrder = ref(params.get('sort_order') || 'asc');

const performSearch = () => {
    router.get(route("plants.index"), {
        searchTest: searchTerm.value,
        sortKey: currentSortKey.value,
        sortOrder: currentSortOrder.value,
    });
};

const handleSort = ({sortBy,sortOrder}) => {
    currentSortKey.value = sortBy;
    currentSortOrder.value = sortOrder;
    performSearch();
};

const isNoData = computed(() => !params.get("searchTest") && props.plants.data.length === 0);

const noResultsFound = computed(() => {
    return searchTerm.value && props.plants.data.length === 0;
});



const isPopupVisible = ref(false);
const selectedPlant = ref(null);

const openEditPopup = (plant) =>{
    selectedPlant.value = plant;
    isPopupVisible.value = true;
};

const togglePopup = () => {
    isPopupVisible.value = !isPopupVisible.value;
};

const handleClose = () => {
    isPopupVisible.value = false;
    selectedPlant.value = null;
};
</script>

<template>
    <div class="flex h-screen w-screen bg-custom-yellow">
        <div>
            <SideBar />
        </div>
        <div class="w-full h-full mr-6 overflow-hidden">
            <div class="flex justify-between pt-8 pb-3">
                <p class="text-custom-green text-2xl">
                    Hi there, {{ $page.props.auth.user.name }}!
                </p>
                <SearchInput>
                    <div class="pl-3 flex items-center">
                <SearchIcon />
                <input
                    class="hover:custom-cursor bg-transparent border-none focus:ring-transparent"
                    type="text"
                    v-model="searchTerm"
                    @input="performSearch"
                    placeholder="Search"
                />
            </div>
            </SearchInput>
            </div>
            <Table :plants="plants" @edit="openEditPopup" @sort="handleSort"></Table>
            <Pagination v-if="!isNoLink" :links="plants.links"/>
            <div class="flex items-center justify-center">
                <NoDataImage @open="togglePopup" v-if="isNoData"></NoDataImage>
                <p v-if="noResultsFound" class="text-custom-gold text-2xl">
                    No results found
                </p>
            </div>
            <div class="fixed bottom-0 right-0 mb-6 mr-6 ">
            <AddButton
                class="hover:custom-cursor"
                @click="togglePopup"
            />
        </div>
        </div>
        <Popup v-if="isPopupVisible" @close="handleClose" :plant="selectedPlant" />
    </div>
</template>
