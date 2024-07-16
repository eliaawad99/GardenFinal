<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  userImage: String,
});
</script>

<template>
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="56" height="59" viewBox="0 0 56 59" fill="none">
      <path d="M8.36311 47.0995C17.9944 58.7941 35.0839 60.2842 46.5105 50.4C52.2707 45.4173 54.4742 39.359 53.9162 33.058C53.3682 26.8699 50.1807 20.6411 45.5701 15.0428C40.9632 9.44899 35.4962 5.16565 29.602 3.56345C23.5804 1.92662 17.3467 3.15795 11.5836 8.14307C0.18604 18.0022 -1.24449 35.4337 8.36311 47.0995Z" fill="url(#pattern0_58_8722)" stroke="#E8FF5B" stroke-width="4"/>
      <defs>
        <pattern id="pattern0_58_8722" patternContentUnits="objectBoundingBox" width="1" height="1">
          <image  width="1" height="1" :xlink:href="userImage"/>
        </pattern>
      </defs>
    </svg>
  </div>
</template>
