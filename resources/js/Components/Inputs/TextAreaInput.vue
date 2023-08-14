<script setup>
	import { onMounted, ref } from 'vue'

	defineProps({
		modelValue: String,
	})

	defineEmits(['update:modelValue'])

	const input = ref(null)

	onMounted(() => {
		if (input.value.hasAttribute('autofocus')) {
			input.value.focus()
		}
	})

	defineExpose({ focus: () => input.value.focus() })
</script>

<template>
	<textarea ref="input"
	          rows="4"
	          class="
			block
			p-2.5
			w-full
			text-gray-900
			rounded-lg
			border border-gray-300
			focus:border-indigo-300
			focus:ring
			focus:ring-indigo-500
			focus:ring-opacity-50
		"
	          placeholder="Start typing ..."
	          :value="modelValue"
	          @input="$emit('update:modelValue', $event.target.value)"></textarea>
</template>
