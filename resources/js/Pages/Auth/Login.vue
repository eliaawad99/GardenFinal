<script setup>
import ButtonContainer from '@/Assets/ButtonContainer.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { defineEmits } from 'vue';

const emit = defineEmits(['switchComponent']);

const handleSwitch = (event) => {
    event.preventDefault();
    emit('switchComponent');
}


const buttonText = 'Hop Back In'; // Set the button text here or retrieve dynamically

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div class="flex flex-col justify-center items-center font-irish-grover mb-9">
            <h1 class="text-custom-green text-2xl font-normal leading-normal">Howdy there!</h1>
            <p class="text-center text-custom-gold text-base font-normal leading-normal">Welcome back to To-Dew-List
                Plant
                Tracker, we hope you keep all your dandy plants alive!</p>
        </div>


        <form @submit.prevent="submit">
            <div>

                <TextInput id="email" type="email" class="mt-1 block w-full border-0" v-model="form.email" required
                    autofocus autocomplete="username" placeholder="Email" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">

                <TextInput id="password" type="password" class="mt-1 block w-full border-0" v-model="form.password"
                    required autocomplete="current-password" placeholder="Password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>



            <div class="flex flex-col items-center justify-end mt-5">
                <ButtonContainer class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    :buttonText="buttonText">
                </ButtonContainer>
                <div class="font-irish-grover mt-5">
                    <p class="text-custom-gold inline"> Don't have an account?</p>
                    <a @click="handleSwitch" href="#" class="text-custom-green hover:text-green-500">
                        Register Here
                    </a>
                </div>


            </div>
        </form>
    </GuestLayout>
</template>
