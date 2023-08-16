<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link  } from '@inertiajs/vue3';
import BaseTable from '@/Components/Tables/BaseTable.vue';
import TableHead from '@/Components/Tables/TableHead.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';

const props = defineProps({
    notifications: {
        type: Object
    }
})

</script>

<template>
    <AppLayout title="Notifications">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Notifications
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div class="px-4 sm:px-6 lg:px-8 py-6 bg-white rounded-lg">
                    <BaseTable v-if="props.notifications.length > 0">
                        <template #header>
                            <TableHead class="">Hashid</TableHead>
                            <TableHead class="">User</TableHead>
                            <TableHead class="">Created At</TableHead>
                        </template>
                        <template #body>
                            <TableRow v-for="row in props.notifications"
                                        :key="row.id">
                                <TableData>{{ row.id }}</TableData>

                                <TableData class="text-gray-900">
                                    <Link :href="route('admin.users.show', row.id)">
                                        {{  row.first_name }} {{ row.last_name }}
                                    </Link>
                                </TableData>

                                <TableData class="">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{
                                            new Date(row.created_at).toLocaleDateString('en-US', {
                                                year: 'numeric',
                                                month: 'short',
                                                day: '2-digit',
                                            })
                                        }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ new Date(row.created_at).toLocaleTimeString('en-US') }}
                                    </div>
                                </TableData>
                            </TableRow>
                        </template>
                    </BaseTable>

                    <div v-else class="text-center text-gray-500 py-8"> No notifications available</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
