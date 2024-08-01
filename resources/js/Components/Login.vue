<script setup>
import ButtonContainer from '@/Assets/ButtonContainer.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const buttonText = 'Hop Back In';

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
    <div class="bg-custom-yellow px-20 pt-9 pb-14 skew-y-1 rounded-tl-[25px] rounded-tr-[40px] rounded-br-[15px] rounded-bl-[30px]">

        <Head title="Log in" />

        <div class="flex flex-col justify-center items-center pb-4">
            <h1 class="text-custom-green text-3xl leading-normal">Howdy there!</h1>
            <p class="text-center text-custom-gold w-[369px]">Welcome back to To-Dew-List
                Plant
                Tracker, we hope you keep all your dandy plants alive!</p>
        </div>


        <form @submit.prevent="submit">
            

                <TextInput id="email" type="email" v-model="form.email" required
                    autofocus placeholder="Email" />

                <InputError class="mt-2" :message="form.errors.email" />
        

            

                <TextInput id="password" type="password" v-model="form.password"
                    required placeholder="Password" />

                <InputError class="mt-2" :message="form.errors.password" />
            



            <div class="flex flex-col items-center mt-6">
                <ButtonContainer
                    :buttonText="buttonText" />
                
            </div>
        </form>
        <div class="mt-5 text-xl">
                    <p class="text-custom-gold inline"> Don't have an account?</p>
                    <Link :href="route('register')" class="text-custom-green hover:text-green-500 custom-cursor">
                        Register Here
                    </Link>
                </div>
    </div>
</template>
