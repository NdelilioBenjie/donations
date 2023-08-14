<script setup>
import { computed } from 'vue'

const props = defineProps({
    theme: {
        type: String,
        required: false,
        default: 'indigo',
    },
    size: {
        type: String,
        required: false,
        default: 'base',
    },
    type: {
        type: String,
        default: 'submit',
    }
})

const theme = computed(() => {
    return {
        primary:
            'text-white bg-primary-500 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 hover:bg-primary-600 active:bg-primary-600 bg-primary-50',
        secondary: 'bg-gray-100 active:bg-gray-200 text-gray-700 focus:outline-none focus:border-gray-200 focus:ring focus:ring-gray-400 hover:bg-gray-200 ',
        red: 'text-white focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 hover:bg-red-700 active:bg-red-900 bg-red-500',
        orange:
            'text-white focus:outline-none focus:border-yellow-900 focus:ring focus:ring-yellow-300 hover:bg-yellow-600 active:bg-yellow-600 bg-yellow-500',
        green:
            'text-white focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 hover:bg-green-600 active:bg-green-600 bg-green-500',
        blue: 'text-white bg-blue-500 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 hover:bg-blue-600 active:bg-blue-600 bg-blue-50',
        indigo: 'text-white bg-indigo-500 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 hover:bg-indigo-600 active:bg-indigo-600 bg-indigo-50',
        transparent: 'text-gray-500'
    }[props.theme.toString()]
})

const size = computed(() => {
    return {
        base: 'px-4 py-3 text-sm ',
        sm: 'px-2 py-1 text-sm ',
    }[props.size.toString()]
})
</script>

<template>
    <button :type="type"
        class="inline-flex items-center border border-transparent rounded-md font-semibold disabled:opacity-25 justify-center transition"
        :class="`${theme}  ${size}`">
        <slot />
    </button>
</template>
