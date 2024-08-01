<script setup>
import ButtonContainer from "@/Assets/ButtonContainer.vue";
import EmptyImage from "@/Assets/EmptyImage.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import TextInput from "./TextInput.vue";

const emit = defineEmits(["close"]);

const user = usePage().props.auth.user;

const closePopupProfile = () => {
    emit("close");
};

const buttonText = "Save Changes";

const form = useForm({
    image: "",
    imageUrl: user.image,
    name: user.name,
    email: user.email,
    current_password: '',
    password: '',
    password_confirmation: '',
});

const handleFileUpload = (e) => {
    const file = e.target.files[0];
    form.image = file;
    form.imageUrl = URL.createObjectURL(file);
};

const submit = () =>{
    form.post(route('profile.update'),{
        onSuccess: () => {
            emit("close");
        },
    });
};

const logout = () => {
    router.post(route("logout"), {
        onFinish: () => {
            window.location.href = route("testing");
        },
    });
};
</script>

<template>
    <div
        class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-20"
    >
        <div
            class="bg-custom-yellow pl-12 pr-16 pt-11 pb-10 skew-y-1 rounded-tl-[25px] rounded-tr-[40px] rounded-br-[15px] rounded-bl-[30px]"
        >
            <div class="flex items-center justify-between pb-10">
                <div class="flex">
                    <img
                        src="/images/CloseIcon.svg"
                        class="custom-cursor"
                        @click="closePopupProfile"
                    />
                    <p class="text-custom-green text-2xl ml-6">
                        Edit Farmer Profile
                    </p>
                </div>
                <p class="text-cursor custom-cursor" @click="logout">Log Out</p>
            </div>
            <div class="flex justify-center">
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div
                        class="flex justify-center items-center bg-input-color h-28 skew-x-3 w-[400px] relative custom-cursor"
                    >
                        <label
                            for="image"
                            class="absolute inset-0 flex items-center custom-cursor"
                        >
                            <EmptyImage
                                class="ml-4"
                                :imageUrl="form.imageUrl"
                                :width="56" :height="56"
                            />
                            <span class="pl-4 text-custom-gold">
                                Upload Image
                            </span>
                        </label>
                        <input
                            id="image"
                            type="file"
                            class="absolute inset-0 opacity-0 custom-cursor"
                            @change="handleFileUpload"
                        />
                    </div>

                    <TextInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        autofocus
                        placeholder="Name"
                    />
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        autofocus
                        placeholder="Email"
                    />
                    <TextInput
                        id="oldPassword"
                        type="password"
                        v-model="form.current_password"
                        autofocus
                        placeholder="Old Password"
                    />
                    <div v-if="form.errors.current_password" class="text-red-500 pt-2">{{ form.errors.current_password }}</div>
                    <TextInput
                        id="newPassword"
                        type="password"
                        v-model="form.password"
                        autofocus
                        placeholder="New Password"
                    />
                    <div v-if="form.errors.password" class="text-red-500 pt-2">{{ form.errors.password }}</div>
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        autofocus
                        placeholder="Confirm New Password"
                    />
                    <div v-if="form.errors.password_confirmation" class="text-red-500 pt-2">{{ form.errors.password_confirmation }}</div>
                    <div class="flex justify-center pt-4">
                        <ButtonContainer
                            class="text-2xl"
                            :buttonText="buttonText"
                        />
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
