<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-serif font-medium leading-5 text-cyan-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-sans font-semibold leading-5 text-cyan-900 hover:text-cyan-700 hover:border-cyan-300 focus:outline-none focus:text-cyan-700 focus:border-cyan-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
