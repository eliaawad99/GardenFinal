<script setup>
import ProfileImage from '@/Assets/ProfileImage.vue';
</script>

<template>
    <div class="relative h-full w-full flex items-center">
        <div class=" h-[94.7%] w-[82.3%] relative py-9 ml-4 bg-custom-green -skew-y-3 skew-x-0.25 rounded-xl">
            <div class="h-full w-full flex flex-col justify-between">
                <div class="h-full w-full flex justify-center">
                    <img class=" h-[13%] w-[82.3%]" src="/images/ToDo.svg">
                </div>
                <div class="flex justify-center">
                    <ProfileImage></ProfileImage>
                    <div class="flex flex-col justify-center items-start ml-2">
                        <p>{{ $page.props.auth.user.name }}</p>
                        <p>Edit Profile</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
