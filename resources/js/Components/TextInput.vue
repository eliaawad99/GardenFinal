<script setup>
import { ref } from 'vue';

const model = defineModel({
  type: String,
  required: true,
});

const inputRef = ref(null);

defineExpose({
  focus: () => inputRef.value.focus(),
});
</script>

<template>
  <div class="relative bg-input-color skew-x-12 w-[400px] h-[48px] mt-6 border-0 rounded">
    
    <input
      class="absolute inset-0 z-10 w-full h-full border-0 bg-transparent px-4 py-2 ring-transparent focus:ring-transparent font-irish-grover placeholder:text-custom-gold text-header-background"
      v-model="model"
      ref="inputRef"
      :autofocus="$attrs.autofocus"
      :placeholder="$attrs.placeholder"
    />
    <slot/>
  </div>
</template>
