<script setup>
import ButtonContainer from '@/Assets/ButtonContainer.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import TextInput from './TextInput.vue';

const isPopupProfileVisible = ref(true);

const closePopupProfile = () => {
    isPopupProfileVisible.value = false;
};

const buttonText = 'Save Changes';

const form = useForm({
    imageProfile:'',
    editName:'',
    editEmail:'',
    oldPassword:'',
    newPassword:'',
    confirmPassword:'',

});

const submit = () =>{
    form.post(route(''), {
        onFinish: () =>form.reset('oldPassword' , 'newPassword' , 'confirmPassword')
    });
}


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
                <p class="text-cursor">Log Out</p>
            </div>
            <div class="flex justify-center">
                <div>
                    <form @submit.prevent="submit">
                    <TextInput id="imageProfile" type="file" class="h-28 skew-x-3" v-model="form.imageProfile" autofocus placeholder="Upload Image"/>
                    <TextInput id="editName" type="text" v-model="form.editName" autofocus placeholder="Name"/>
                    <TextInput id="editEmail" type="email" v-model="form.editEmail" autofocus placeholder="Email"/>
                    <TextInput id="oldPassword" type="password" v-model="form.oldPassword" autofocus placeholder="Old Password"/>
                    <TextInput id="newPassword" type="password" v-model="form.newPassword" autofocus placeholder="New Password"/>
                    <TextInput id="confirmPassword" type="password" v-model="form.confirmPassword" autofocus placeholder="Confirm Password"/>
                    <div class="flex justify-center pt-4">
                    <ButtonContainer class="text-2xl":buttonText="buttonText">
                    </ButtonContainer>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>