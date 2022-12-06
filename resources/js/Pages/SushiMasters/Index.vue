<script setup>
import { ref, onMounted } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";

const search = ref(null);

defineProps({
    sushi_masters: Object,
});

const onSearch = (search) => {
    location.href = `/sushis/masters?search=${search}`;
};

onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const searchQuery = params.get("search");
    search.value = searchQuery;
});
</script>

<template>
    <AppLayout title="Sushi Masters">
        <template #header>
            <h2
                class="font-semibold text-xl text-white leading-tight justify-center"
            >
                Sushi Masters
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-slate-800 overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <div class="w-full flex">
                        <div class="w-1/2">
                            <Link :href="route('sushis.masters.create')">
                                <PrimaryButton>
                                    Add New Sushi Master
                                </PrimaryButton>
                            </Link>
                            <Link :href="route('sushis.masters.trashed')">
                                <PrimaryButton class="ml-4">
                                    Trashed Sushi Master
                                </PrimaryButton>
                            </Link>
                        </div>
                        <div class="w-1/2">
                            <TextInput
                                id="search"
                                type="text"
                                class="block w-full"
                                placeholder="Search Sushi Masters..."
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
                                            <thead
                                                class="bg-slate-700 border-b"
                                            >
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="text-sm font-medium text-start text-white px-6 py-4"
                                                    >
                                                        ID
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="text-sm font-medium text-start text-white px-6 py-4"
                                                    >
                                                        Sushi Master Name
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="text-sm font-medium text-start text-white px-6 py-4"
                                                    >
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    class="bg-white border-b"
                                                    v-if="
                                                        sushi_masters.length > 0
                                                    "
                                                    v-for="sushi_master in sushi_masters"
                                                    :key="sushi_master.id"
                                                >
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                    >
                                                        {{ sushi_master.id }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                    >
                                                        {{ sushi_master.name }}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <Link
                                                            :href="
                                                                route(
                                                                    'sushis.masters.edit',
                                                                    sushi_master.id
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
                                                                    'sushis.masters.destroy',
                                                                    sushi_master.id
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
                                                        colspan="3"
                                                        class="text-sm text-center text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                    >
                                                        There is no data
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
        </div>
    </AppLayout>
</template>
