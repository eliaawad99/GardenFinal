<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    links: Array,
});


</script>

<template>
    <div class="flex justify-center mt-4">
        <Link class="flex w-6 justify-center custom-cursor bg-cover hover:bg-pagination-hover"
            v-for="link in props.links.filter((_, i) => i !== 0 && i !== props.links.length - 1)" :key="link.label"
            :href="link.url" :class="{
                'text-custom-yellow': link.active,
                'text-header-background': !link.active
            }" :style="{ backgroundImage: link.active ? 'url(/images/PaginationBackground.svg)' : '' }">
            <span  v-html="link.label"></span>
        </Link>
    </div>
</template>
