<script setup>
import ArrowIcon from "@/Assets/ArrowIcon.vue";
import EditButton from "@/Assets/EditButton.vue";
import EmptyImage from "@/Assets/EmptyImage.vue";
import OpenImage from "@/Components/OpenImage.vue";
import { defineProps, ref } from "vue";
import Sun from "./Sun.vue";
import Water from "./Water.vue";

const props = defineProps({
    plants: Object,
});

const emit = defineEmits(['edit']);

const isOpenImage = ref(false);
const selectedImage = ref(null);

const showImage = (imageUrl) => {
    selectedImage.value = imageUrl;
    isOpenImage.value = true;
};

const isArrowClicked = ref({
    name: false,
    species: false,
    watering: false,
    datePlanted: false,
    soilType: false,
    drainage: false,
    fertilizer: false,
    sunlight: false,
    humidity: false,
    notes: false,
});

const headers = [
    {title: 'Child Name', type: 'name'},
    {title: 'Species/ Variety', type: 'species'},
    {title: 'Watering', type: 'watering'},
    {title: 'Date Planted', type: 'datePlanted'},
    {title: 'Soil Type', type: 'soilType'},
    {title: 'Drainage', type: 'drainage'},
    {title: 'Fertilizer', type: 'fertilizer'},
    {title: 'Sunlight', type: 'sunlight'},
    {title: 'Humidity', type: 'humidity'},
    {title: 'Notes', type: 'notes'},
]

const currentSortKey = ref(null);

const toggleArrowDirection = (key) => {
    if (currentSortKey.value === key) {
        isArrowClicked.value[key] = !isArrowClicked.value[key];
    } else {
        Object.keys(isArrowClicked.value).forEach(k => {
            isArrowClicked.value[k] = false;
        });
        isArrowClicked.value[key] = true;
        currentSortKey.value = key;
    }
};

const handleEdit = (plant) => {
    emit('edit', plant)
};


</script>

<template>
    <div class="overflow-auto max-h-[80%]">
        <table class="divide-gray-200 border-separate border-spacing-y-2">
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
                    <th class="w-[109px] pl-2" v-for="header in headers">
                        <div
                            class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection( header.type )"
                        >
                            <span class="text-start">{{ header.title }}</span>
                            <ArrowIcon
                                class="duration-300"
                                :class="{
                                    'ml-2': true,
                                    'transform rotate-90': isArrowClicked[header.type],
                                }"
                                :color="
                                    isArrowClicked[header.type] ? '#E8FF5B' : '#FFF8D2'
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
                    class="h-[80px]"
                    v-for="plant in plants.data"
                    :key="plant.id"
                    style="
                        background-image: url('/images/TableBackgroundBody.svg');
                        background: cover;
                        background-repeat: no-repeat;
                        background-size: cover;
                    "
                >
                    <td class="pl-3">
                        <div class="flex justify-center">
                            <EmptyImage :imageUrl="plant.image" :width="32" :height="32" @click="showImage(plant.image)"/>
                        </div>
                    </td>
                    <td
                        class="duration-300"
                        :class="{ 'text-custom-green': isArrowClicked.name }"
                    >
                        {{ plant.name }}
                    </td>
                    <td
                        class="duration-300"
                        :class="{ 'text-custom-green': isArrowClicked.species }"
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
                            'text-custom-green': isArrowClicked.datePlanted,
                        }"
                    >
                        {{ plant.date_planted }}
                    </td>
                    <td
                        class="duration-300"
                        :class="{
                            'text-custom-green': isArrowClicked.soilType,
                        }"
                    >
                        {{ plant.soil_type }}
                    </td>
                    <td
                        class="duration-300"
                        :class="{
                            'text-custom-green': isArrowClicked.drainage,
                        }"
                    >
                        {{ plant.drainage }}
                    </td>
                    <td
                        class="duration-300"
                        :class="{
                            'text-custom-green': isArrowClicked.fertilizer,
                        }"
                    >
                        {{ plant.fertilizer }}
                    </td>
                    <td>
                        <Sun class="hover:custom-cursor":sunlight="plant.sunlight"></Sun>
                    </td>
                    <td
                        class="duration-300"
                        :class="{
                            'text-custom-green': isArrowClicked.humidity,
                        }"
                    >
                        {{ plant.humidity }}
                    </td>
                    <td
                        class="duration-300 overflow-hidden text-ellipsis"
                        :class="{ 'text-custom-green': isArrowClicked.notes }"
                    >
                        {{ plant.notes }}
                    </td>
                    <td>
                        <EditButton class="hover:custom-cursor" @click="handleEdit(plant)"></EditButton>
                    </td>
                </tr>
            </tbody>
        </table>
        <OpenImage :image="selectedImage" v-if="isOpenImage" @close="isOpenImage=false" />
    </div>
</template>
