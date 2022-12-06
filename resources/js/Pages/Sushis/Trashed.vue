<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

// const onPermanentRemove = (route) => {
//     const remove = confirm("Are you sure to permanently remove this data?");
//     if (remove) {
//         location.href = route;
//     }
// };

defineProps({
    trashed_sushis: Object,
});
</script>

<template>
    <AppLayout title="Sushi Types">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Trashed Sushis
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
                                                    class="text-sm font-bold text-white px-6 py-4 text-start"
                                                >
                                                    ID
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-start"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-start"
                                                >
                                                    Sushi Type
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-start"
                                                >
                                                    Sushi Master
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-start"
                                                >
                                                    Quantity
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-start"
                                                >
                                                    Price
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-start"
                                                >
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="bg-slate-50 border-b transition duration-300 ease-in-out hover:bg-slate-100"
                                                v-if="trashed_sushis.length > 0"
                                                v-for="trashed_sushi in trashed_sushis"
                                                :key="trashed_sushi.id"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                                >
                                                    {{ trashed_sushi.id }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{ trashed_sushi.name }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{
                                                        trashed_sushi.sushi_type_name
                                                    }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{
                                                        trashed_sushi.sushi_master_name
                                                    }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{ trashed_sushi.quantity }}
                                                    PCS
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    ${{ trashed_sushi.price }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'sushis.restore',
                                                                trashed_sushi.id
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
                                                                'sushis.destroy_permanent',
                                                                trashed_sushi.id
                                                            )
                                                        "
                                                    >
                                                        <DangerButton>
                                                            Permanently Remove
                                                        </DangerButton>
                                                    </Link>
                                                    <!-- <DangerButton
                                                        class="ml-4"
                                                        @click="
                                                            onPermanentRemove(
                                                                route(
                                                                    'sushis.destroy_permanent',
                                                                    trashed_sushi.id
                                                                )
                                                            )
                                                        "
                                                    >
                                                        Permanently Remove
                                                    </DangerButton> -->
                                                </td>
                                            </tr>
                                            <tr
                                                class="bg-slate-50 border-b transition duration-300 ease-in-out hover:bg-slate-100"
                                                v-else
                                            >
                                                <td
                                                    colspan="7"
                                                    class="text-sm text-center text-gray-900 font-light px-6 py-4 whitespace-nowrap"
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
