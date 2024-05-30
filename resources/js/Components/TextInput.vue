<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="block w-full shadow-sm border-none focus:border py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:border-amber-600 dark:focus:border-amber-500 focus:ring-amber-600 dark:focus:ring-amber-500 disabled:text-gray-500 dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 sm:text-sm sm:leading-6 bg-white/0 dark:bg-white/5 ring-1 dark:ring-white/20 rounded-md"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
