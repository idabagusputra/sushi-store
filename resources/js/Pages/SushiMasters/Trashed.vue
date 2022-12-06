<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

defineProps({
    trashed_sushi_masters: Object,
});
</script>

<template>
    <AppLayout title="Sushi Masters">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Trashed Sushi Masters
            </h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-slate-200 overflow-hidden shadow-xl sm:rounded-lg mt-8"
                >
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="inline-block min-w-full sm:px-6 lg:px-8"
                            >
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                        <thead class="bg-slate-700 border-b">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white text-center px-6 py-4 text-left"
                                                >
                                                    ID
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white text-center px-6 py-4 text-left"
                                                >
                                                    Sushi Type Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white text-center px-6 py-4 text-left"
                                                >
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="bg-slate-50 border-b transition duration-300 ease-in-out hover:bg-slate-100"
                                                v-if="
                                                    trashed_sushi_masters.length >
                                                    0
                                                "
                                                v-for="trashed_sushi_master in trashed_sushi_masters"
                                                :key="trashed_sushi_master.id"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-900"
                                                >
                                                    {{
                                                        trashed_sushi_master.id
                                                    }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 text-center whitespace-nowrap"
                                                >
                                                    {{
                                                        trashed_sushi_master.name
                                                    }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 text-center whitespace-nowrap"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'sushis.masters.restore',
                                                                trashed_sushi_master.id
                                                            )
                                                        "
                                                    >
                                                        <PrimaryButton>
                                                            Restore
                                                        </PrimaryButton>
                                                    </Link>
                                                    <Link
                                                        :href="
                                                            route(
                                                                'sushis.masters.destroy_permanent',
                                                                trashed_sushi_master.id
                                                            )
                                                        "
                                                    >
                                                        <DangerButton
                                                            class="ml-4"
                                                        >
                                                            Permanently Remove
                                                        </DangerButton>
                                                    </Link>
                                                </td>
                                            </tr>
                                            <tr
                                                class="bg-slate-50 border-b transition duration-300 ease-in-out hover:bg-slate-100"
                                                v-else
                                            >
                                                <td
                                                    colspan="3"
                                                    class="text-sm text-center text-gray-900 font-light text-center px-6 py-4 whitespace-nowrap"
                                                >
                                                    There is no trashed data
                                                    available
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
