<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue', 'label', 'id', 'type', 'placeholder', 'disabled', 'subClass']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

</script>
<template>
    <div class="relative">
        <label for="id" class="tracking-wide block mb-2 text-xs font-bold text-gray-900 uppercase">{{ label }}</label>
        <input :type="type" :id="id" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" class="bg-white text-gray-900 text-sm rounded-lg block w-full p-3 font-medium  focus:outline-none border-gray-200 focus:ring-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 dark:shadow-lg dark:shadow-blue-800/80 transition ease-in-out duration-150" :class="subClass" :disabled="disabled == 'true'" :placeholde="placeholder" required="">
        <p v-if="$slots.helper" id="helper-text-explanation" class="mt-2 text-xs text-gray-500 dark:text-gray-400">
        <span class="text-red-500">*</span><slot name="helper"></slot>
        </p>
    </div>
</template>