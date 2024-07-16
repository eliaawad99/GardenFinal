<script setup>
import ButtonContainer from "@/Assets/ButtonContainer.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const buttonText = "Get Gardenin'";

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <div
        class="bg-custom-yellow flex flex-col px-20 pt-9 pb-14 skew-y-1 rounded-tl-[25px] rounded-tr-[40px] rounded-br-[15px] rounded-bl-[30px]"
    >
        <Head title="Register" />
        <div class="flex flex-col justify-center items-center mb-4">
            <h1 class="text-custom-green text-3xl leading-normal">
                Howdy there!
            </h1>
            <p class="text-center text-custom-gold leading-normal w-[369px]">
                Welcome to To-Dew-List Plant Tracker, we hope you keep all your
                dandy plants alive!
            </p>
        </div>

        <form @submit.prevent="submit">
            <TextInput
                id="name"
                type="text"
                v-model="form.name"
                required
                autofocus
                placeholder="Name"
            />

            <InputError class="mt-1" :message="form.errors.name" />

            <TextInput
                id="email"
                type="email"
                v-model="form.email"
                required
                placeholder="Email"
            />

            <InputError class="mt-1" :message="form.errors.email" />

            <TextInput
                id="password"
                type="password"
                v-model="form.password"
                required
                placeholder="Create Password"
            />

            <InputError class="mt-1" :message="form.errors.password" />

            <TextInput
                id="password_confirmation"
                type="password"
                v-model="form.password_confirmation"
                required
                placeholder="Confirm Password"
            />

            <InputError
                class="mt-1"
                :message="form.errors.password_confirmation"
            />

            <div class="flex flex-col items-center justify-end mt-6">
                <ButtonContainer
                    class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :buttonText="buttonText"
                />
                <div class="mt-5">
                    <p class="text-custom-gold inline">
                        Already have an account?
                    </p>
                    <Link
                        href="/"
                        class="text-custom-green hover:text-green-500"
                    >
                        Log in here
                    </Link>
                </div>
            </div>
        </form>
    </div>
</template>
