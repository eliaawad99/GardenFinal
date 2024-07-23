<script setup>
import ButtonContainer from "@/Assets/ButtonContainer.vue";
import EmptyImage from "@/Assets/EmptyImage.vue";
import SunIcon from "@/Assets/SunIcon.vue";
import WaterIcon from "@/Assets/WaterIcon.vue";
import InputError from "@/Components/InputError.vue"; // Import InputError component
import RateInput from "@/Components/RateInput.vue";
import { useForm } from "@inertiajs/vue3";
import DropdownInput from "./DropdownInput.vue";
import TextInput from "./TextInput.vue";

const props = defineProps({
    plant: Object,
});

const emit = defineEmits(["close"]);

const buttonText = "Add Item";

const closePopup = () => {
    emit("close");
};

const isSun = (index) => {
    return index <= form.sunlight;
};

const selectSunlight = (value) => {
    form.sunlight = value;
};

const isWater = (index) => {
    return index <= form.watering;
};

const selectWater = (value) => {
    form.watering = value;
};

const form = useForm({
    imageUrl: props.plant ? props.plant.image : "",
    image: "",
    name: props.plant ? props.plant.name : "",
    species: props.plant ? props.plant.species : "",
    watering: props.plant ? props.plant.watering : "0",
    date_planted: props.plant ? props.plant.date_planted : "",
    soil_type: props.plant ? props.plant.soil_type : "",
    drainage: props.plant ? props.plant.drainage : "",
    fertilizer: props.plant ? props.plant.fertilizer : "",
    sunlight: props.plant ? props.plant.sunlight : "0",
    humidity: props.plant ? props.plant.humidity : "",
    notes: props.plant ? props.plant.notes : "",
});

const handleFileUpload = (e) => {
    const file = e.target.files[0];
    form.image = file;
    form.imageUrl = URL.createObjectURL(file);
};

const submit = () => {
    if (props.plant) {
        form.post(
            route("plants.update", props.plant.id), {
                onSuccess: () => {
                    emit("close");
                },
            }
        );
    } else {
        form.post(
            route("plants.store"), {
                onSuccess: () => {
                    emit("close");
                },
            }
        );
    }
};

const selectPlaceholderSpecies = "Species/Variety";
const selectOptionsSpecies = [
    { value: "Trifoliate Orange", label: "Trifoliate Orange" },
    { value: "Petunia", label: "Petunia" },
    { value: "Moses in the Cradle", label: "Moses in the Cradle" },
    { value: "Lettuce", label: "Lettuce" },
    { value: "Honey Suckle", label: "Honey Suckle" },
    { value: "Sunflower", label: "Sunflower" },
    { value: "Basil", label: "Basil" },
];
const selectPlaceholderSoil = "Soil Type";
const selectOptionsSoil = [
    { value: "Peat-based", label: "Peat-based" },
    { value: "Acidic", label: "Acidic" },
    { value: "Sandy", label: "Sandy" },
    { value: "Loamy", label: "Loamy" },
    { value: "Well-drained", label: "Well-drained" },
];
const selectPlaceholderDrainage = "Drainage";
const selectOptionsDrainage = [
    { value: "Low", label: "Low" },
    { value: "Medium", label: "Medium" },
    { value: "High", label: "High" },
];
const selectPlaceholderFertilizer = "Fertilizer";
const selectOptionsFertilizer = [
    { value: "Liquid Fertilizer", label: "Liquid Fertilizer" },
    { value: "50$", label: "50$" },
    { value: "10-10-10 Fertilizer", label: "10-10-10 Fertilizer" },
    { value: "Organic Fertilizer", label: "Organic Fertilizer" },
    { value: "Acidic Fertilizer", label: "Acidic Fertilizer" },
];
const selectPlaceholderHumidity = "Humidity";
const selectOptionsHumidity = [
    { value: "We Humid", label: "We humid" },
    { value: "Alright", label: "Alright" },
    { value: "Coastal", label: "Coastal" },
];
</script>

<template>
    <div class="fixed z-20 inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="pl-12 pt-11 pb-10 pr-16 bg-custom-yellow skew-y-1 rounded-tl-[25px] rounded-tr-[40px] rounded-br-[15px] rounded-bl-[30px]">
            <div class="flex">
                <img src="/images/CloseIcon.svg" @click="closePopup" class="custom-cursor" />
                <p class="text-custom-green text-3xl ml-6">Add your Plant Child</p>
            </div>
            <form @submit.prevent="submit">
                <div class="flex pl-9 pt-10">
                    <div class="pr-11">
                        <div class="bg-input-color h-28 rounded skew-x-3 w-[400px] relative">
                            <label for="image" class="absolute inset-0 flex items-center">
                                <EmptyImage class="ml-4" :imageUrl="form.imageUrl" :width="56" :height="56" />
                                <span class="pl-4 text-custom-gold">Upload Image</span>
                            </label>
                            <input id="image" type="file" class="absolute inset-0 opacity-0 cursor-pointer" @change="handleFileUpload" />
                        </div>

                        <TextInput id="name" type="text" v-model="form.name" required autofocus placeholder="Plant Child Name" />
                        <InputError class="mt-2" :message="form.errors.name" />

                        <DropdownInput v-model="form.species" :placeholder="selectPlaceholderSpecies" :options="selectOptionsSpecies" />
                        <InputError class="mt-2" :message="form.errors.species" />

                        <RateInput type="Water Requirement">
                            <div class="flex gap-1">
                                <WaterIcon :height="24" v-for="n in 5" :key="n" :color="isWater(n) ? 'green' : '#DED295'" @click="selectWater(n)" />
                            </div>
                        </RateInput>
                        <InputError class="mt-2" :message="form.errors.watering" />

                        <div class="flex bg-input-color skew-x-12 w-[400px] h-[48px] mt-6 border-0 rounded justify-between items-center pl-6 text-custom-gold">
                            <label for="date">Date Planted</label>
                            <input class="bg-transparent border-none focus:ring-transparent" id="date" type="date" v-model="form.date_planted" placeholder="Date Planted" />
                        </div>
                        <InputError class="mt-2" :message="form.errors.date_planted" />

                        <DropdownInput v-model="form.soil_type" :placeholder="selectPlaceholderSoil" :options="selectOptionsSoil" />
                        <InputError class="mt-2" :message="form.errors.soil_type" />
                    </div>
                    <div>
                        <DropdownInput v-model="form.drainage" :placeholder="selectPlaceholderDrainage" :options="selectOptionsDrainage" class="!mt-0" />
                        <InputError class="mt-2" :message="form.errors.drainage" />

                        <DropdownInput v-model="form.fertilizer" :placeholder="selectPlaceholderFertilizer" :options="selectOptionsFertilizer" />
                        <InputError class="mt-2" :message="form.errors.fertilizer" />

                        <RateInput type="Sunlight">
                            <div class="flex gap-1">
                                <SunIcon v-for="n in 5" :key="n" :color="isSun(n) ? 'green' : '#DED295'" @click="selectSunlight(n)" />
                            </div>
                        </RateInput>
                        <InputError class="mt-2" :message="form.errors.sunlight" />

                        <DropdownInput v-model="form.humidity" :placeholder="selectPlaceholderHumidity" :options="selectOptionsHumidity" />
                        <InputError class="mt-2" :message="form.errors.humidity" />

                        <textarea v-model="form.notes" class="bg-input-color skew-x-3 w-[400px] h-[192px] mt-6 border-0 rounded placeholder:text-custom-gold focus:ring-transparent overflow-auto resize-none" placeholder="Notes"></textarea>
                        <InputError class="mt-2" :message="form.errors.notes" />
                    </div>
                </div>
                <div class="flex justify-center pt-4">
                    <ButtonContainer class="text-2xl" :buttonText="buttonText" />
                </div>
            </form>
        </div>
    </div>
</template>
