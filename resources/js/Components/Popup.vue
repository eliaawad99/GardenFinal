<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import TextInput from './TextInput.vue';

const isPopupVisible = ref(true);

const closePopup = () => {
    isPopupVisible.value = false;
};

const form = useForm({
    name: '',
    species: '',
    watering: '',
    date_planted: '',
    soil_type: '',
    drainage: '',
    fertilizer: '',
    sunlight: '',
    humidity: '',
    notes: '',
});

const submit = () => {
    form.post(route(''));
};
</script>

<template>
    <div v-if="isPopupVisible" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="h-700 w-1000 pl-11 pt-11 bg-custom-yellow rounded-custom-7 font-irish-grover">
            <div class="flex">
                <img src="/images/CloseIcon.svg" @click="closePopup">
                <p class="text-custom-green text-2xl ml-6">Add your Plant Child</p>
            </div>
            <form @submit.prevent="submit">
                <div class="flex pl-11 pt-5">
                    <div class="pr-11">
                        <TextInput id="image" type="file" v-model="form.image" required autofocus placeholder="Upload Image"/>
                        <TextInput id="name" type="text" v-model="form.name" required
                    autofocus placeholder="Plant Child Name" />
                        <TextInput id="species" type="text" v-model="form.species" required autofocus placeholder="Species/Variety"></TextInput>
                        <TextInput></TextInput>
                        <TextInput></TextInput>
                        <TextInput></TextInput>
                    </div>
                    <div>
                        <TextInput></TextInput>
                        <TextInput></TextInput>
                        <TextInput></TextInput>
                        <TextInput></TextInput>
                        <TextInput></TextInput>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
