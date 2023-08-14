<script setup>
    import { computed, ref } from 'vue';
    import { Switch, SwitchDescription, SwitchGroup, SwitchLabel } from '@headlessui/vue'

    const emit = defineEmits(['update:checked']);

    const props = defineProps({
        title: {
            type: String,
        },
        description: {
            type: String,
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

    const enabled = ref(props.checked)
</script>


<template>
    <SwitchGroup as="div"
                 class="flex items-center justify-between  space-x-2">
        <span class="flex flex-grow flex-col">
            <SwitchLabel v-if="title"
                         as="span"
                         class="text-sm font-medium leading-6 text-gray-900"
                         passive>{{ title }}</SwitchLabel>
            <SwitchDescription v-if="description"
                               as="span"
                               class="text-sm text-gray-500">{{ description}}</SwitchDescription>
        </span>
        <Switch v-model="enabled"
                @update:modelValue="(value) => $emit('update:modelValue', value)"
                :class="[enabled ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
            <span aria-hidden="true"
                  :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
        </Switch>
    </SwitchGroup>
</template>
