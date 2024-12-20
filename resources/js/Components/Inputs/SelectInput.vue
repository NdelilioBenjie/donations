<script setup>
	import { ref, computed, watch } from 'vue'
	import {
		Listbox,
		ListboxButton,
		ListboxLabel,
		ListboxOption,
		ListboxOptions,
	} from '@headlessui/vue'
	import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

	const props = defineProps({
		modelValue: {
			type: [String, Number],
			required: true,
		},
		options: {
			type: [Array, Object],
			required: true,
			default: () => [],
		},
		id: {
			type: String,
			required: true,
		},
		name: {
			type: String,
			required: true,
		},
		placeholder: {
			type: String,
			required: false,
		},
	})

	watch(props.modelValue, (newValue, oldValue) => {
		selected.value = newValue;
	});

	const selected = ref(props.modelValue)
</script>

<template>
	<Listbox as="div"
	         v-model="selected"
	         :modelValue="modelValue"
	         @update:modelValue="(value) => $emit('update:modelValue', value)">
		<ListboxLabel v-if="placeholder"
		              class="block text-sm font-medium text-gray-700">{{ placeholder}}</ListboxLabel>
		<div class="relative "
		     :class="[placeholder? 'mt-2': '']">
			<ListboxButton class="
					relative
					w-full
					cursor-default
					rounded-md
					border border-gray-300
					bg-white
					py-3
					pl-3
					pr-10
					text-left
					shadow-sm
					focus:border-indigo-500
					focus:outline-none
					focus:ring-1
					focus:ring-indigo-500
					sm:text-sm
				">
				<span class="block truncate text-gray-900"
				      v-if="selected">
						<span v-if="selected[name]">{{ selected[name] }}</span>
						<span v-else>{{ selected }}</span>
				</span>
				<span class="block truncate"
				      v-else>Select an option</span>
				<span class="
						pointer-events-none
						absolute
						inset-y-0
						right-0
						flex
						items-center
						pr-2
					">
					<ChevronUpDownIcon class="h-5 w-5 text-gray-400"
					                   aria-hidden="true" />
				</span>
			</ListboxButton>

			<transition leave-active-class="transition ease-in duration-100"
			            leave-from-class="opacity-100"
			            leave-to-class="opacity-0">
				<ListboxOptions class="
						absolute
						z-10
						mt-1
						max-h-60
						w-full
						overflow-auto
						rounded-md
						bg-white
						py-1
						text-base
						shadow-lg
						ring-1 ring-black ring-opacity-5
						focus:outline-none
						sm:text-sm
					"
				                @input="$emit('update:modelValue', $event.target.value)">
					<ListboxOption as="template"
					               v-for="item in options"
					               :key="item.id"
					               :value="item"
					               v-slot="{ active, selected }">
						<li :class="[
								active ? 'text-white bg-indigo-600' : 'text-gray-900',
								'relative cursor-default select-none py-2 pl-3 pr-9',
							]">
							<span :class="[
									selected ? 'font-semibold' : 'font-normal',
									'block truncate',
								]">
								<span v-if="name">{{ item[name] }}</span>
								<span v-else>{{ item }}</span>
							</span>

							<span v-if="selected"
							      :class="[
									active ? 'text-white' : 'text-indigo-600',
									'absolute inset-y-0 right-0 flex items-center pr-4',
								]">
								<CheckIcon class="h-5 w-5"
								           aria-hidden="true" />
							</span>
						</li>
					</ListboxOption>
				</ListboxOptions>
			</transition>
		</div>
	</Listbox>
</template>