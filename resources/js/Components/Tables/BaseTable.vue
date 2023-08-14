<template>
	<table class="w-full divide-y divide-gray-300"
	       role="table">
		<thead>
			<tr>
				<slot name="header" />
			</tr>
		</thead>
		<tbody class="divide-y divide-gray-200 bg-white"
		       role="rowgroup">
			<slot name="body" />
		</tbody>

		<tfoot>
			<slot name="footer" />
		</tfoot>
	</table>
</template>