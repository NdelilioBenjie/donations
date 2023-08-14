<script setup>
import { defineEmits } from 'vue'
// import ArrowHead from '@/Components/Icons/ArrowHeadIcon.vue'

defineProps({
	sortable: {
		type: Boolean,
		default: false,
	},
})

defineEmits(['sort'])
</script>

<template>
	<th
		class="
			py-3.5
			pl-6
			pr-3
			text-left text-sm
			font-semibold
			text-gray-900
			sm:pl-3
		"
	>
		<template v-if="sortable">
			<button type="button" class="flex gap-3 items-center uppercase">
				<slot />
				<span class="inline-flex flex-col items-center justify-center gap-1">
					<ArrowHead
						:size="3"
						direction="up"
						fill="text-slate-500"
						class="-mb-1"
						@click="$emit('sort', 'asc')"
					/>
					<ArrowHead
						:size="3"
						fill="text-slate-500"
						class="-mt-1"
						@click="$emit('sort', 'desc')"
					/>
				</span>
			</button>
		</template>
		<template v-else>
			<slot />
		</template>
	</th>
</template>
