<script setup>
import { toRefs } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { notify } from "@kyvg/vue3-notification";
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from '@/Jetstream/Button.vue';

const props = defineProps({
    title: String,
    headers: Object,
    rows: Object,
});

const {title, headers, rows} = toRefs(props);

const updateRows = async () => {
    Inertia.reload({ only: ['rows'] });

    notify({
        title: "Data Updated!",
    });
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ this.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                    <table class="table-auto w-full text-sm text-left">
                        <thead>
                        <tr>
                            <th v-for="(header, index) in this.headers" :key="index" class="py-3 px-6">{{ header }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in this.rows" :key="row.id">
                            <td class="py-2 px-6">{{ row.id }}</td>
                            <td class="py-2 px-6">{{ row.first_name }}</td>
                            <td class="py-2 px-6">{{ row.last_name }}</td>
                            <td class="py-2 px-6">
                                <a :href="`mailto:${ row.email}`"
                                   class="text-indigo-700 focus:outline-none focus:text-indigo-800">{{ row.email }}</a>
                            </td>
                            <td class="py-2 px-6">{{ row.date }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <Button type="button" @click="updateRows">Update Table</Button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
