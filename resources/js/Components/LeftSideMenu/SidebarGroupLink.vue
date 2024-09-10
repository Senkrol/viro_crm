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
        ? 'text-viro-red'
        : 'text-white'
);
</script>

<template>
    <Link 
    
    class="relative flex items-center rounded-sm pl-10 py-1 font-medium duration-300 ease-in-out hover:text-viro-red"
    :href="href" :class="classes">
        <slot />
    </Link>
</template>
