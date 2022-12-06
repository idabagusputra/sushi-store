<script setup>
import { ref, onMounted } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";

const search = ref(null);

const onSearch = (search) => {
    location.href = `/sushis?search=${search}`;
};

const onSort = (asc) => {
    location.href = `/sushis?sort=${asc}`;
};

defineProps({
    sushis: Object,
});

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const searchQuery = params.get("search");
    search.value = searchQuery;
});
</script>

<template>
    <AppLayout title="Sushis">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Sushi Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex">
                    <div class="w-1/2">
                        <Link :href="route('sushis.create')">
                            <PrimaryButton> Add New Sushi </PrimaryButton>
                        </Link>
                        <Link :href="route('sushis.trashed')">
                            <PrimaryButton class="ml-4">
                                Trashed Sushi
                            </PrimaryButton>
                        </Link>
                        <PrimaryButton class="ml-4" @click="onSort(true)">
                            Sort By Name
                        </PrimaryButton>
                    </div>
                    <div class="w-1/2">
                        <TextInput
                            id="search"
                            type="text"
                            class="block w-full"
                            placeholder="Search Sushis..."
                            v-model="search"
                            @keyup.enter="onSearch(search)"
                        />
                    </div>
                </div>
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
                                                    No
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
                                                v-if="sushis.length > 0"
                                                v-for="(sushi, index) in sushis"
                                                :key="sushi.id"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                                >
                                                    {{ index + 1 }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{ sushi.name }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{ sushi.sushi_type_name }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{
                                                        sushi.sushi_master_name
                                                    }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{ sushi.quantity }} PCS
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    ${{ sushi.price }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'sushis.edit',
                                                                sushi.id
                                                            )
                                                        "
                                                    >
                                                        <PrimaryButton>
                                                            Edit
                                                        </PrimaryButton>
                                                    </Link>
                                                    <Link
                                                        :href="
                                                            route(
                                                                'sushis.destroy',
                                                                sushi.id
                                                            )
                                                        "
                                                    >
                                                        <DangerButton
                                                            class="ml-4"
                                                        >
                                                            Remove
                                                        </DangerButton>
                                                    </Link>
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
                                                    There is no data available
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
