<script setup>
import ArrowIcon from "@/Assets/ArrowIcon.vue";
import EditButton from "@/Assets/EditButton.vue";
import EmptyImage from "@/Assets/EmptyImage.vue";
import OpenImage from "@/Components/OpenImage.vue";
import OpenNotes from '@/Components/OpenNotes.vue';
import { defineProps, onMounted, ref } from "vue";
import Sun from "./Sun.vue";
import Water from "./Water.vue";

const props = defineProps({
    plants: Object,
});

const uri = window.location.search.substring(1);
const params = new URLSearchParams(uri);
const urlKey = ref(params.get("sortKey"));
const urlOrder = ref(params.get('sortOrder'));

const emit = defineEmits(["edit", "sort"]);

const isOpenImage = ref(false);
const selectedImage = ref(null);

const showImage = (imageUrl) => {
    selectedImage.value = imageUrl;
    isOpenImage.value = true;
};

const isArrowClicked = ref({
    name:  false,
    species: false,
    watering: false,
    date_planted: false,
    soil_type: false,
    drainage: false,
    fertilizer: false,
    sunlight: false,
    humidity: false,
    notes: false,
});

const currentSortKey = ref(null || urlKey);
const currentSortOrder = ref(null);

onMounted(() => {
    if (urlOrder.value === 'asc'){
        isArrowClicked.value[urlKey.value] = true;
    }
    else if(urlOrder.value === 'desc'){
        isArrowClicked.value[urlKey.value] = false;
    }
});

const headers = [
    { title: "Child Name", type: "name" },
    { title: "Species/ Variety", type: "species" },
    { title: "Watering", type: "watering" },
    { title: "Date Planted", type: "date_planted" },
    { title: "Soil Type", type: "soil_type" },
    { title: "Drainage", type: "drainage" },
    { title: "Fertilizer", type: "fertilizer" },
    { title: "Sunlight", type: "sunlight" },
    { title: "Humidity", type: "humidity" },
    { title: "Notes", type: "notes" },
];

const toggleArrowDirection = (key) => {
    if (currentSortKey.value === key) {
        isArrowClicked.value[key] = !isArrowClicked.value[key];
        currentSortOrder.value = isArrowClicked.value[key] ? "asc" : "desc";
    } else {
        Object.keys(isArrowClicked.value).forEach((k) => {
            isArrowClicked.value[k] = false;
        });
        isArrowClicked.value[key] = true;
        currentSortKey.value = key;
        currentSortOrder.value = "asc";
    }

    emit("sort", {
        sortBy: currentSortKey.value,
        sortOrder: currentSortOrder.value,
    });
};

const handleEdit = (plant) => {
    emit("edit", plant);
};

const truncateNotes = (note) => {
    const maxLength = 10;
    if (note.length > maxLength) {
        return note.substring(0, maxLength) + "...";
    }
    return note;
};

const isNotes = ref(false);
const selectedNotes = ref(null);

const notesPopup = (notes) => {
    selectedNotes.value = notes;
    isNotes.value = !isNotes.value;
};
</script>

<template>
    <div :class="{'overflow-auto max-h-[85%]': plants.data.length > 0}">
        <table class="divide-gray-200 border-separate border-spacing-y-2 w-full min-w-[1280px]">
            <thead
                class="bg-transparent h-20 text-custom-yellow"
                style="
                    background-image: url('/images/TableBackground.svg');
                    background: cover;
                    background-repeat: no-repeat;
                    background-size: cover;
                "
            >
                <tr>
                    <th></th>
                    <th class="min-w-[109px] pl-2" v-for="header in headers">
                        <div
                            class="flex items-center justify-center custom-cursor"
                            @click="toggleArrowDirection(header.type)"
                        >
                            <span class="text-start">{{ header.title }}</span>
                            <ArrowIcon
                                :class="{
                                    'ml-2': true,
                                    'transform rotate-90':
                                        isArrowClicked[header.type],
                                }"
                                :color="
                                    isArrowClicked[header.type]
                                        ? '#E8FF5B'
                                        : '#FFF8D2'
                                "
                            />
                        </div>
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody
                class="bg-transparent divide-y divide-gray-200 text-center text-header-background"
            >
                <tr
                    class="h-[80px] bg-[url('/images/TableBackgroundBody.svg')] bg-no-repeat bg-cover"
                    v-for="plant in plants.data"
                    :key="plant.id"
                >
                    <td class="pl-3">
                        <div class="flex justify-center">
                            <EmptyImage
                                :imageUrl="plant.image"
                                :width="32"
                                :height="32"
                                @click="showImage(plant.image)"
                            />
                        </div>
                    </td>
                    <td
                        class="duration-300"
                        :class="{ 'text-custom-green': isArrowClicked.name || (!isArrowClicked.name && urlKey ==='name') }"
                    >
                        {{ plant.name }}
                    </td>
                    <td
                        class="duration-300"
                        :class="{ 'text-custom-green': isArrowClicked.species || (!isArrowClicked.species && urlKey ==='species') }"
                    >
                        {{ plant.species }}
                    </td>
                    <td>
                        <Water
                            :watering="plant.watering"
                            class="hover:custom-cursor"
                        ></Water>
                    </td>
                    <td
                        class="duration-300"
                        :class="{
                            'text-custom-green': isArrowClicked.date_planted || (!isArrowClicked.date_planted && urlKey ==='date_planted')
                        }"
                    >
                        {{ plant.date_planted }}
                    </td>
                    <td
                        class="duration-300"
                        :class="{
                            'text-custom-green': isArrowClicked.soil_type || (!isArrowClicked.soil_type && urlKey ==='soil_type')
                        }"
                    >
                        {{ plant.soil_type }}
                    </td>
                    <td
                        class="duration-300"
                        :class="{
                            'text-custom-green': isArrowClicked.drainage || (!isArrowClicked.drainage && urlKey ==='drainage')
                        }"
                    >
                        {{ plant.drainage }}
                    </td>
                    <td
                        class="duration-300"
                        :class="{
                            'text-custom-green': isArrowClicked.fertilizer || (!isArrowClicked.fertilizer && urlKey ==='fertilizer')
                        }"
                    >
                        {{ plant.fertilizer }}
                    </td>
                    <td>
                        <Sun
                            class="hover:custom-cursor"
                            :sunlight="plant.sunlight"
                        ></Sun>
                    </td>
                    <td
                        class="duration-300"
                        :class="{
                            'text-custom-green': isArrowClicked.humidity || (!isArrowClicked.humidity && urlKey ==='humidity')
                        }"
                    >
                        {{ plant.humidity }}
                    </td>
                    <td
                        class="duration-300"
                        :class="{ 'text-custom-green': isArrowClicked.notes || (!isArrowClicked.notes && urlKey ==='notes')  }"
                        @click="notesPopup(plant.notes)"
                    >
                        {{ truncateNotes(plant.notes) }}
                    </td>
                    <td>
                        <EditButton
                            class="hover:custom-cursor"
                            @click="handleEdit(plant)"
                        ></EditButton>
                    </td>
                </tr>
            </tbody>
        </table>
        <OpenImage
            :image="selectedImage"
            v-if="isOpenImage"
            @close="isOpenImage = false"
            />
            <OpenNotes v-if="isNotes" :notes="selectedNotes" @close="isNotes = false" />
    </div>
</template>
