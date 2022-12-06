<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const typeInput = ref(null);
const masterInput = ref(null);
const nameInput = ref(null);
const quantityInput = ref(null);
const priceInput = ref(null);
const type = ref(null);
const master = ref(null);

const form = useForm({
    type: null,
    master: null,
    name: null,
    quantity: null,
    price: null,
});

const storeData = (sushi_types, sushi_masters) => {
    form.type = type.value ? type.value.id : sushi_types[0].id;
    form.master = master.value ? master.value.id : sushi_masters[0].id;
    form.post(route("sushis.store"), {
        errorBag: "storeData",
        preserveScroll: true,
        onError: () => {
            if (form.errors.type) {
                form.reset("type");
                typeInput.value.focus();
            }
            if (form.errors.master) {
                form.reset("master");
                masterInput.value.focus();
            }
            if (form.errors.name) {
                form.reset("name");
                nameInput.value.focus();
            }
            if (form.errors.quantity) {
                form.reset("quantity");
                quantityInput.value.focus();
            }
            if (form.errors.price) {
                form.reset("price");
                priceInput.value.focus();
            }
        },
    });
};

const chooseType = (sushi_type) => {
    type.value = sushi_type;
};

const chooseMaster = (sushi_master) => {
    master.value = sushi_master;
};

defineProps({
    sushi_types: Object,
    sushi_masters: Object,
});
</script>

<template>
    <AppLayout title="Sushis">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Sushis
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submitted="storeData(sushi_types, sushi_masters)">
                <template #title>Add Sushi</template>

                <template #description>
                    Add a new sushi data to database.
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="type" value="Sushi Type" />
                        <div class="dropdown relative mt-2 w-full">
                            <button
                                ref="typeInput"
                                class="dropdown-toggle w-full px-6 py-3 bg-slate-200 text-gray-800 font-medium text-sm leading-tight capitalize rounded shadow-md hover:bg-slate-300 hover:shadow-lg focus:bg-slate-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-slate-200 active:shadow-lg transition duration-150 ease-in-out flex items-center whitespace-nowrap"
                                type="button"
                                id="type"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                {{ type ? type.name : sushi_types[0].name }}
                                <div class="w-full flex justify-end">
                                    <svg
                                        aria-hidden="true"
                                        focusable="false"
                                        data-prefix="fas"
                                        data-icon="caret-down"
                                        class="w-2 ml-2"
                                        role="img"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <ul
                                class="dropdown-menu min-w-max absolute w-full bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
                                aria-labelledby="dropdown_type"
                            >
                                <li
                                    class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                    v-for="sushi_type in sushi_types"
                                    @click="chooseType(sushi_type)"
                                >
                                    {{ sushi_type.name }}
                                </li>
                            </ul>
                        </div>
                        <InputError :message="form.errors.type" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="master" value="Sushi Master" />
                        <div class="dropdown relative mt-2 w-full">
                            <button
                                ref="masterInput"
                                class="dropdown-toggle w-full px-6 py-3 bg-slate-200 text-gray-800 font-medium text-sm leading-tight capitalize rounded shadow-md hover:bg-slate-300 hover:shadow-lg focus:bg-slate-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-slate-200 active:shadow-lg transition duration-150 ease-in-out flex items-center whitespace-nowrap"
                                type="button"
                                id="master"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                {{
                                    master ? master.name : sushi_masters[0].name
                                }}
                                <div class="w-full flex justify-end">
                                    <svg
                                        aria-hidden="true"
                                        focusable="false"
                                        data-prefix="fas"
                                        data-icon="caret-down"
                                        class="w-2 ml-2"
                                        role="img"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <ul
                                class="dropdown-menu min-w-max absolute w-full bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
                                aria-labelledby="dropdown_store"
                            >
                                <li
                                    class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                    v-for="sushi_master in sushi_masters"
                                    @click="chooseMaster(sushi_master)"
                                >
                                    {{ sushi_master.name }}
                                </li>
                            </ul>
                        </div>
                        <InputError
                            :message="form.errors.master"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="name" value="Sushi Name" />
                        <TextInput
                            id="name"
                            ref="nameInput"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="quantity" value="Sushi Quantity" />
                        <TextInput
                            id="quantity"
                            ref="quantityInput"
                            v-model="form.quantity"
                            type="number"
                            class="mt-1 block w-full"
                        />
                        <InputError
                            :message="form.errors.quantity"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="price" value="Sushi Price" />
                        <TextInput
                            id="price"
                            ref="priceInput"
                            v-model="form.price"
                            type="number"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.price" class="mt-2" />
                    </div>
                </template>

                <template #actions>
                    <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </ActionMessage>

                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Save
                    </PrimaryButton>
                </template>
            </FormSection>
        </div>
    </AppLayout>
</template>
