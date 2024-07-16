<script setup>
import ProfileImage from '@/Assets/ProfileImage.vue';
import PopupProfile from '@/Components/PopupProfile.vue';
import { ref } from 'vue';

const isPopupProfileVisible = ref(false);

const togglePopupProfile = () => {
    isPopupProfileVisible.value = !isPopupProfileVisible.value;
};


</script>

<template>
    <div class="h-full w-full flex items-center">
        <div class="h-[95%] w-[186px] py-9 ml-4 mr-6 bg-custom-green -skew-y-3 skew-x-[0.25deg] rounded-xl">
            <div class="h-full flex flex-col justify-between">
                <div class="flex justify-center">
                    <img src="/images/ToDo.svg">
                </div>
                <div class="flex justify-center">
                    <ProfileImage :userImage="$page.props.auth.user.image"></ProfileImage>
                    <div class="flex flex-col justify-center items-start ml-2">
                        <p class="text-custom-yellow">{{ $page.props.auth.user.name }}</p>
                        <p @click="togglePopupProfile" class="text-edit hover:custom-cursor">Edit Profile</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <PopupProfile v-if="isPopupProfileVisible" @close="isPopupProfileVisible = false"></PopupProfile>
</template>
