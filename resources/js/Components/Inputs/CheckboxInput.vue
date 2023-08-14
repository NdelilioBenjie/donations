<script setup>
    import { computed } from 'vue';
    import InputLabel from '@/Components/Inputs/InputLabel.vue'

    const emit = defineEmits(['update:checked']);

    const props = defineProps({
        label: {
            type: String,
        },
        id: {
            type: String,
            default: 'my-custom-checkbox-id'
        },
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            type: String,
            default: null,
        },
    });

    const proxyChecked = computed({
        get() {
            return props.checked;
        },

        set(val) {
            emit('update:checked', val);
        },
    });
</script>


<template>
    <div class="flex items-center">
        <input v-model="proxyChecked"
               type="checkbox"
               :value="value"
               :id="id"
               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">

        <InputLabel class="cursor-pointer ml-2"
                    :value="label"
                    v-if="label"
                    :for="id" />
    </div>
</template>
