<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        required: true
    },
    options: {
        type: Array,
        required: true
    },
    placeholder: {
        type: String,
        default: 'Select one from the list'
    }
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
    emit('update:modelValue', event.target.value);
};

const isEmptyValue = computed(() => !props.modelValue);

const selectClass = computed(() => {
    return isEmptyValue.value
        ? 'text-custom-gold'
        : 'text-header-background';
});
</script>

<template>
    <select
    class="bg-input-color skew-x-12 border-0 rounded w-[400px] h-12 px-6 focus:ring-transparent mt-4 block"
        :class="selectClass"
        :value="modelValue"
        @change="updateValue"
    >
        <option class="text-custom-gold" value="" disabled selected>{{ placeholder }}</option>
        <option
            class="text-custom-gold"
            v-for="(option, index) in options"
            :key="index"
            :value="option.value"
        >
            {{ option.label }}
        </option>
    </select>
</template>
