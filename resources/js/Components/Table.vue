<script setup>
import ArrowIcon from '@/Assets/ArrowIcon.vue';
import EditButton from '@/Assets/EditButton.vue';
import { computed, defineProps, ref, watch, provide } from 'vue';
import Pagination from './Pagination.vue';
import Water from './Water.vue';

const props = defineProps({
    plants: Object,
    plant: Object,
});

const isArrowClicked = ref({
    name: false,
    species: false,
    datePlanted: false,
    soilType: false,
    drainage: false,
    fertilizer: false,
    sunlight: false,
    humidity: false,
    notes: false,
});

provide('isArrowClicked', isArrowClicked);

const currentSortKey = ref(null);

const sortPlants = computed(() => {
    if (currentSortKey.value) {
        const key = currentSortKey.value;
        const sortedData = [...props.plant.data].sort((a, b) => a[key].localeCompare(b[key]));
        return isArrowClicked.value[key] ? sortedData : props.plant.data;
    }
    return props.plant.data;
});

const toggleArrowDirection = (key) => {
    if (currentSortKey.value === key) {
        isArrowClicked.value[key] = !isArrowClicked.value[key];
    } else {
        Object.keys(isArrowClicked.value).forEach(k => isArrowClicked.value[k] = false);
        isArrowClicked.value[key] = true;
        currentSortKey.value = key;
    }
};

watch(isArrowClicked, (newValue) => {
    const noneClicked = Object.values(newValue).every(value => !value);
    if (noneClicked) {
        currentSortKey.value = null;
    }
});

</script>

<template>
    <div>
        <table class="w-full max-h-full divide-gray-200 border-separate border-spacing-y-2">
            <thead class="bg-transparent h-20 text-custom-yellow"
                style="background-image: url('/images/TableBackground.svg'); background: cover; background-repeat: no-repeat; background-size: cover">
                <tr>
                    <th></th>
                    <th>
                        <div class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection('name')">
                            <span>Child Name</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.name }"
                                :color="isArrowClicked.name ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
                    </th>
                    <th>
                        <div class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection('species')">
                            <span>Species/Variety</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.species }"
                                :color="isArrowClicked.species ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
                    </th>
                    <th>Watering</th>
                    <th>
                        <div class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection('datePlanted')">
                            <span>Date Planted</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.datePlanted }"
                                :color="isArrowClicked.datePlanted ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
                    </th>
                    <th>
                        <div class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection('soilType')">
                            <span>Soil Type</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.soilType }"
                                :color="isArrowClicked.soilType ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
                    </th>
                    <th>
                        <div class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection('drainage')">
                            <span>Drainage</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.drainage }"
                                :color="isArrowClicked.drainage ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
                    </th>
                    <th>
                        <div class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection('fertilizer')">
                            <span>Fertilizer</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.fertilizer }"
                                :color="isArrowClicked.fertilizer ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
                    </th>
                    <th>
                        <div class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection('sunlight')">
                            <span>Sunlight</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.sunlight }"
                                :color="isArrowClicked.sunlight ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
                    </th>
                    <th>
                        <div class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection('humidity')">
                            <span>Humidity</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.humidity }"
                                :color="isArrowClicked.humidity ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
                    </th>
                    <th>
                        <div class="flex items-center justify-center cursor-pointer"
                            @click="toggleArrowDirection('notes')">
                            <span>Notes</span>
                            <ArrowIcon class="duration-300"
                                :class="{ 'ml-2': true, 'transform rotate-90': isArrowClicked.notes }"
                                :color="isArrowClicked.notes ? '#E8FF5B' : '#FFF8D2'" />
                        </div>
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="bg-transparent divide-y divide-gray-200 text-center text-header-background">
                <tr class="h-[82px]" v-for="plant in sortPlants" :key="plant.id"
                    style="background-image: url('/images/TableBackgroundBody.svg'); background: cover; background-repeat: no-repeat; background-size: cover">
                    <td class="pl-3">
                        <div class="flex justify-center"><img :src="plant.image" class="w-[32px]" alt="plant image">
                        </div>
                    </td>
                    <td class="duration-300" :class="{ 'text-custom-green': isArrowClicked.name }">{{ plant.name }}
                    </td>
                    <td class="duration-300" :class="{ 'text-custom-green': isArrowClicked.species }">{{
                        plant.species }}</td>
                    <td>
                        <Water :watering="plant.watering" class="hover:Custom-Cursor"></Water>
                    </td>
                    <td class="duration-300" :class="{ 'text-custom-green': isArrowClicked.datePlanted }">{{
                        plant.date_planted }}</td>
                    <td class="duration-300" :class="{ 'text-custom-green': isArrowClicked.soilType }">{{
                        plant.soil_type }}</td>
                    <td class="duration-300" :class="{ 'text-custom-green': isArrowClicked.drainage }">{{
                        plant.drainage }}</td>
                    <td class="duration-300" :class="{ 'text-custom-green': isArrowClicked.fertilizer }">{{
                        plant.fertilizer }}</td>
                    <td class="duration-300" :class="{ 'text-custom-green': isArrowClicked.sunlight }">{{
                        plant.sunlight }}</td>
                    <td class="duration-300" :class="{ 'text-custom-green': isArrowClicked.humidity }">{{
                        plant.humidity }}</td>
                    <td class="duration-300" :class="{ 'text-custom-green': isArrowClicked.notes }">{{ plant.notes
                        }}</td>
                    <td>
                        <EditButton class="hover:Custom-Cursor"></EditButton>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :links="plants.links" />
    </div>
</template>
