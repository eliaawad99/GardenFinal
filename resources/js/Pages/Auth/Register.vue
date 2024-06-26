<script setup>
import ButtonContainer from '@/Assets/ButtonContainer.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { defineEmits } from 'vue';

const emit = defineEmits (['switchComponent']);

const handleSwitch = (event) => {
    event.preventDefault();
    emit('switchComponent');
}

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const buttonText = "Get Gardenin'"; 

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />
        <div class="flex flex-col justify-center items-center font-irish-grover mb-6">
            <h1 class="text-custom-green text-2xl font-normal leading-normal">Howdy there!</h1>
            <p class="text-center text-custom-gold text-base font-normal leading-normal">Welcome to To-Dew-List Plant
                Tracker, we hope you keep all your dandy plants alive!</p>
        </div>


        <form @submit.prevent="submit">
            <div>


                <TextInput id="name" type="text" class="mt-1 block w-full border-0" v-model="form.name" required
                    autofocus autocomplete="name" placeholder="Name" />

                <InputError class="mt-1" :message="form.errors.name" />
            </div>

            <div class="mt-2">


                <TextInput id="email" type="email" class="mt-1 block w-full border-0" v-model="form.email" required
                    autocomplete="username" placeholder="Email" />

                <InputError class="mt-1" :message="form.errors.email" />
            </div>

            <div class="mt-2">

                <TextInput id="password" type="password" class="mt-1 block w-full border-0" v-model="form.password"
                    required autocomplete="new-password" placeholder="Create Password" />

                <InputError class="mt-1" :message="form.errors.password" />
            </div>

            <div class="mt-2">

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full border-0"
                    v-model="form.password_confirmation" required autocomplete="new-password"
                    placeholder="Confirm Password" />

                <InputError class="mt-1" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex flex-col items-center justify-end mt-5">
                <ButtonContainer class="{ 'opacity-25': form.processing }" :disabled="form.processing" :buttonText="buttonText">
                </ButtonContainer>
                <div class="font-irish-grover mt-5">
                    <p class="text-custom-gold inline"> Already have an account?</p>
                    <a @click="handleSwitch" href="#" class="text-custom-green hover:text-green-500">
                    Log in here
                    </a>
                </div>


            </div>
        </form>
    </GuestLayout>
</template>
