<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    image: null,
    species: '',
    watering: '',
    datePlanted: '',
    soilType: '',
    drainage: '',
    fertilizer: '',
    sunlight: '',
    humidity: '',
    notes: '',
});

const submit = () => {
    form.post(route("plants.store")) ;
};
</script>

<template>
    <Head title="New Plants" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Plants</h2>
        </template>
        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">
                <form class="p-4" @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-2">
                <InputLabel for="image" value="Image" />

                <TextInput
                    id="image"
                    type="file"
                    class="mt-1 block w-full"
                    @input="form.image= $event.target.file[0]"
                />

                <InputError class="mt-2" :message="form.errors.image" />
            </div>

            <div>
                <InputLabel class="mt-2" for="species" value="Species" />

                <select
                    id="species"
                    class="mt-1 block w-full"
                    v-model="form.species"
                >

                <option value="">Select Species</option>
            <option value="Coastal">Coastal</option>
            <option value="Alright">Alright</option>
            <option value="We Humid">We Humid</option>
        </select>

                <InputError class="mt-2" :message="form.errors.species" />
            </div>

            <div>
                <InputLabel class="mt-2" for="watering" value="Watering" />

                <TextInput
                    id="watering"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.watering"
                />

                <InputError class="mt-2" :message="form.errors.watering" />
            </div>

            <div>
                <InputLabel class="mt-2" for="datePlanted" value="Date planted" />

                <TextInput
                    id="datePlanted"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.datePlanted"
                />

                <InputError class="mt-2" :message="form.errors.datePlanted" />
            </div>

            <div>
                <InputLabel class="mt-2" for="soilType" value="Soil type" />

                <select
                    id="soilType"
                    class="mt-1 block w-full"
                    v-model="form.soilType"
                >

                <option>Select Fertilizer</option>
      <option>Coastal</option>
      <option>Alright</option>
      <option>We Humid</option>
    </select>

                <InputError class="mt-2" :message="form.errors.soilType" />
            </div>
            
            <div>
                <InputLabel class="mt-2" for="drainage" value="Drainage" />

                <select
                    id="drainage"
                    class="mt-1 block w-full"
                    v-model="form.drainage"
                >

                <option>Select Fertilizer</option>
      <option>Coastal</option>
      <option>Alright</option>
      <option>We Humid</option>
    </select>

                <InputError class="mt-2" :message="form.errors.drainage" />
            </div>

            <div>
                <InputLabel class="mt-2" for="fertilizer" value="Fertilizer" />

                <select
                    id="fertilizer"
                    class="mt-1 block w-full"
                    v-model="form.fertilizer"
                >

                <option value="">Select Fertilizer</option>
    <option value="coastal">Coastal</option>
    <option value="alright">Alright</option>
    <option value="we-humid">We Humid</option>
    </select>

                <InputError class="mt-2" :message="form.errors.fertilizer" />
            </div>

            <div>
                <InputLabel class="mt-2" for="sunlight" value="Sunlight" />

                <TextInput
                    id="sunlight"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.sunlight"
                />

                <InputError class="mt-2" :message="form.errors.sunlight" />
            </div>

            <div>
                <InputLabel class="mt-2" for="humidity" value="Humidity" />

                <select
                    id="humidity"
                    class="mt-1 block w-full"
                    v-model="form.humidity"
                >

                <option>Select Humidity Level</option>
      <option>Coastal</option>
      <option>Alright</option>
      <option>We Humid</option>
    </select>

                <InputError class="mt-2" :message="form.errors.humidity" />
            </div>
            <div>
                <InputLabel class="mt-2" for="notes" value="Notes" />

                <textarea
                    id="notes"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.notes"
                />

                <InputError class="mt-2" :message="form.errors.notes" />
            </div>

            

            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>

            


        </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>