<script setup>
import ButtonContainer from '@/Assets/ButtonContainer.vue';
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import TextInput from './TextInput.vue';

const user = usePage().props.auth.user;

const isPopupProfileVisible = ref(true);

const closePopupProfile = () => {
    isPopupProfileVisible.value = false;
};

const buttonText = 'Save Changes';

const form = ref({
    image: '',
    name: user.name,
    email: user.email,
    oldPassword: '',
    newPassword: '',
    confirmPassword: ''
});

const handleFileUpload = (e) => {
    form.value.image = e.target.files[0];
}

function submit() {
    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('email', form.value.email);
    formData.append('oldPassword', form.value.oldPassword);
    formData.append('newPassword', form.value.newPassword);
    formData.append('confirmPassword', form.value.confirmPassword);
    formData.append('image', form.value.image);

    console.log(formData.get('name'))
    console.log(formData.get('oldPassword'))
    console.log(formData.get('newPassword'))
    console.log(formData.get('confirmPassword'))

    formData.append('_method', 'PUT');

    router.post(route('profile.update'), formData, {
        forceFormData: true,
        onError: (error) => {
            console.log(error);
        },
        onStart: (value) => {
            console.log(value);
        }
    });
}

// const submit = () => {
//     form.patch(route('profile.update'), {
//         onFinish: () => {
//             form.reset('oldPassword', 'newPassword', 'confirmPassword');
//             closePopupProfile();
//         },
//     });
// };

const logout = () => {
    form.post(route('logout'), {
        onFinish: () => {
            window.location.href = route('testing');
        }
    });
};
</script>

<template>
    <div v-if="isPopupProfileVisible"
        class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-10">
        <div class="bg-custom-yellow px-14 py-11 rounded-custom-7 skew-y-0.5">
            <div class="flex items-center justify-between pb-2">
                <div class="flex">
                    <img src="/images/CloseIcon.svg" @click="closePopupProfile" class="cursor-pointer">
                    <p class="text-custom-green text-2xl ml-6">Edit Farmer Profile</p>
                </div>
                <p class="text-cursor" @click="logout">Log Out</p>
            </div>
            <div class="flex justify-center">
                <div>
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <input id="image" type="file" class="h-28 skew-x-3 flex items-center" @change="handleFileUpload"
                            autofocus placeholder="Upload Image">
                        <img class="pl-[24px]" src="/images/EmptyImage.svg" />
                        <TextInput id="name" type="text" v-model="form.name" autofocus placeholder="Name" />
                        <TextInput id="email" type="email" v-model="form.email" autofocus placeholder="Email" />
                        <TextInput id="oldPassword" type="password" v-model="form.oldPassword" autofocus
                            placeholder="Old Password" />
                        <TextInput id="newPassword" type="password" v-model="form.newPassword" autofocus
                            placeholder="New Password" />
                        <TextInput id="confirmPassword" type="password" v-model="form.confirmPassword" autofocus
                            placeholder="Confirm New Password" />
                        <div class="flex justify-center pt-4">
                            <ButtonContainer class="text-2xl" :buttonText="buttonText">
                            </ButtonContainer>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>