<script setup>
    import { onMounted, ref } from 'vue';
</script>

<template>
    <div class="relative">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 pr-10">
            <slot name="left" />
        </div>

        <div class="w-full">
            <slot name="input" />
        </div>

        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 pl-10">
            <slot name="right" />
        </div>
    </div>
</template>
