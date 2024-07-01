<script setup>

const props = defineProps({
    links: Array,
});


</script>

<template>
    <div class="flex justify-center mt-4">
        <a class="flex w-6 justify-center Custom-Cursor"
            v-for="link in props.links.filter((_, i) => i !== 0 && i !== props.links.length - 1)" :key="link.label"
            :href="link.url" :class="{
                'text-custom-green': link.active,
                'text-header-background': !link.active
            }">
            <span v-html="link.label"></span>
        </a>
    </div>
</template>
