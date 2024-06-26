<script setup>
import EditButton from '@/Assets/EditButton.vue';
defineProps({
    plants:Array,
})
</script>



<template>

        <table class="w-full h-full divide-gray-200 border-separate border-spacing-y-2">
            <thead class=" bg-transparent h-[11.4%] text-custom-yellow" style="background-image: url('/images/TableBackground.svg'); background: cover; background-repeat: no-repeat; background-size: cover">
                
                <tr>
                    <th></th>
                    <th>Child Name</th>
                    <th>Species/Variety</th>
                    <th>Watering</th>
                    <th>Date Planted</th>
                    <th>Soil Type</th>
                    <th>Drainage</th>
                    <th>Fertilizer</th>
                    <th>Sunlight</th>
                    <th>Humidity</th>
                    <th>Notes</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="bg-transparent divide-y divide-gray-200 text-center text-header-background">
                <tr v-for="plant in plants" :key="plant.id" style="background-image: url('/images/TableBackgroundBody.svg'); background: cover; background-repeat: no-repeat; background-size: cover">
                    <td>{{ plant.image }}</td>
                    <td>{{ plant.name }}</td>
                    <td>{{ plant.species }}</td>
                    <td>{{ plant.watering }}</td>
                    <td>{{ plant.date_planted }}</td>
                    <td>{{ plant.soil_type }}</td>
                    <td>{{ plant.drainage }}</td>
                    <td>{{ plant.fertilizer }}</td>
                    <td>{{ plant.sunlight }}</td>
                    <td>{{ plant.humidity }}</td>
                    <td>{{ plant.notes }}</td>
                    <td><EditButton></EditButton></td>
                </tr>
            </tbody>
        </table>

</template>
