<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import axios from "axios";
import { ref, onMounted, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from "@/Components/DialogModal.vue";
import Kartu from "@/Components/Card.vue";
import Input from "@/Components/InputFloathing.vue";
import Data from "@/Components/Data.vue";
import { reactive } from "vue";

onMounted(() => {
    getMachine()
});

const loadingSec = ref(false);
const machine = ref({});

//get machinne data
const getMachine = () => {
    machine.value = {};
    loadingSec.value = true;
    axios
        .get(route("machine.index"))
        .then((res) => {
            const data = res.data;
            machine.value = data;
            loadingSec.value = false;
        })
        .catch((err) => {
            alert(`Fail to load data \n\nError: ${err}`);
        });
};
const current_page = ref(1);
const setPage = (i) => {
    if (i) {
        const s = i.url.split("?page=");
        const p = s[1];
        current_page.value = p;
        getMachine();
    }
};

//add new class
const pageClasess = (i) => {
    if (i.active) {
        return "text-white bg-cyan-600 border-cyan-600 cursor-allowed";
    } else if (i.url == null) {
        return "text-gray-400 cursor-not-allowed";
    } else {
        return "text-gray-600 hover:bg-gray-100";
    }
};

const formMachine = useForm({
    serNum: "",
    name: "",
    color: "",
    price: "",
    yom: "",
});

const fillForm = (i) => {
    formMachine.serNum = i.serNum;
    formMachine.name = i.name;
    formMachine.color = i.color;
    formMachine.price = i.price;
    formMachine.yom = i.yom;
};

const machine_id = ref(false);

const modal = reactive({
    open: false,
    tipe: "",
    status: false,
    data: "",
    detail: false,
});

const addModal = () => {
    modal.open = true;
    modal.tipe = "add";
    detailMachine.value = false;
    resetForm();
};

const modalAdd = () => {
    formMachine.reset();
    modal.tipe = "add";
    modal.open = true;
};

const modalEdit = () => {
    modal.tipe = "edit";
    modal.detail = false;
    modal.open = true;
};

const resetForm = () => {
    formMachine.reset();
    formMachine.clearErrors();
    machine_id.value = false;
};

const detailMachine = ref(false);
const modalDetail = (d) => {
    fillForm(d);
    machine_id.value = false;
    detailMachine.value = d;
    modal.detail = true;
};

const saveMachine = () => {
    formMachine.clearErrors();
    formMachine
        .transform((data) => ({
            ...data,
            machine_id: machine_id.value,
        }))
        .post(route("machine.store"), {
            onSuccess: () => {
                modal.open = false;
                resetForm();
                getMachine();
                alert("Success");
            },
        });
};

const editMachine = () => {
    const data = detailMachine.value;
    machine_id.value = data.id;
    formMachine.post(route("machine.update"));

    formMachine.serNum = data.serNum;
    formMachine.name = data.name;
    formMachine.color = data.color;
    formMachine.price = data.price;
    formMachine.yom = data.yom;
};

const deleteMachine = () => {
    if (confirm("Sure want to delete it?")) {
        const machine_id = detailMachine.value.id
        axios.delete(route("machine.destroy", {machine_id}))
            .then(() => {
                alert(`Sucsess`);
                modal.detail = false;
                resetForm();
                getMachine();
            })
            .catch((err) => {
                alert(`Fail to delete \n\nError: ${err}`);
            });
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-8 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-end mb-1">
                        <button
                            @click="addModal()"
                            type="button"
                            class="rounded-md px-2 py-1 text-white bg-gray-500 hover:bg-gray-600"
                        >
                            Add
                        </button>
                    </div>
                    <div class="container mx-auto">
                        <table class="w-full">
                            <thead class="bg-black text-white">
                                <tr>
                                    <td class="px-3 py-2 font-bold w-5">No.</td>
                                    <td class="px-3 py-2 font-bold">
                                        Serial Number
                                    </td>
                                    <td class="px-3 py-2 font-bold">Nama</td>
                                    <td class="px-3 py-2 font-bold">Warna</td>
                                    <td class="px-3 py-2 font-bold">Harga</td>
                                    <td class="px-3 py-2 font-bold">
                                        Tahun Pembuatan
                                    </td>
                                    <td class="px-3 py-2 font-bold">Menu</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(d, index) in machine"
                                    :key="index"
                                    class="even:bg-blue-50 hover:bg-blue-100"
                                >
                                    <td class="px-3 py-2">{{ index + 1 }}</td>
                                    <td class="px-3 py-2">{{ d.serNum }}</td>
                                    <td class="px-3 py-2">{{ d.name }}</td>
                                    <td class="px-3 py-2">{{ d.color }}</td>
                                    <td class="px-3 py-2">{{ d.price }}</td>
                                    <td class="px-3 py-2">{{ d.yom }}</td>
                                    <td class="px-3 py-2">
                                        <a
                                            href="#"
                                            class="font-medium text-blue-600 hover:underline"
                                            @click.prevent="modalDetail(d)"
                                            >Detail</a
                                        >
                                    </td>
                                </tr>
                                <tr v-if="loadingSec">
                                    <td
                                        colspan="3"
                                        class="px-2 py-1 text-center font-bold"
                                    >
                                        Mohon Tunggu
                                    </td>
                                </tr>
                                <tr
                                    v-else-if="
                                        machine &&
                                        (!machine || (machine && machine <= 0))
                                    "
                                >
                                    <td
                                        colspan="3"
                                        class="px-2 py-1 text-center font-bold"
                                    >
                                        Tidak Ada Data
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal
        :show="modal.open"
        @close="
            [
                (modal.open = false),
                modal.tipe == 'edit'
                    ? (modal.detail = true)
                    : (modal.detail = false),
                (modal.status = false),
            ]
        "
        max-width="7xl"
        class-header="text-gray-900 shadow-lg shadow-gray-700/10"
        class-bg="bg-white"
    >
        <template #title>
            <template v-if="modal.tipe == 'add'"> Add Machine </template>
            <template v-if="modal.tipe == 'edit'"> Change Machine </template>
        </template>
        <template #content>
            <!-- <form action="#">
            </form> -->
            <div
                class="mt-10 px-6 flex sm:flex-row flex-col justify-between space-x-12"
            >
                <div class="flex-col w-full">
                    <template v-if="modal.tipe == 'add' || modal.tipe == 'edit'">
                        <div class="w-full">
                            <Input
                                type="text"
                                label="Serial Number"
                                id="serNum"
                                v-model="formMachine.serNum"
                                placeholder=""
                            />
                        </div>
                        <div class="w-full">
                            <Input
                                type="text"
                                label="Name"
                                id="name"
                                v-model="formMachine.name"
                                placeholder=""
                            />
                        </div>
                        <div class="w-full">
                            <Input
                                type="text"
                                label="Color"
                                id="color"
                                v-model="formMachine.color"
                                placeholder=""
                            />
                        </div>
                        <div class="w-full">
                            <Input
                                type="text"
                                label="Price"
                                id="price"
                                v-model="formMachine.price"
                                placeholder=""
                            />
                        </div>
                        <div class="w-full">
                            <Input
                                type="date"
                                label="Year Of Manufacture"
                                id="yom"
                                v-model="formMachine.yom"
                                placeholder=""
                            />
                        </div>
                    </template>
                </div>
            </div>
        </template>
        <template #footer>
            <div class="flex justify-end spac-x-2 py-4">
                <button
                    @click="saveMachine()"
                    type="button"
                    class="rounded-md px-2 py-1 bg-green-600 hover:bg-green-700 text-white"
                >
                    Simpan
                </button>
            </div>
        </template>
    </Modal>
    <Modal
        :show="modal.detail"
        @close="[(modal.detail = false)]"
        max-width="4xl"
        classHeader="text-gray-900 shadow-lg shadow-gray-700/10"
        class-bg="bg-white"
        class-content=""
    >
        <template #title> Detail Machine </template>
        <template #content>
            <div class="relative mt-8 mx-10">
                <div class="overflow-x-auto px-6 py-4 bg-white rounded-md">
                    <table
                        class="w-full text-xs uppercase font-medium trackin-wide text-gray-900 text-left table-auto overflow-scroll"
                    >
                        <tbody>
                            <Data
                                title="Serial Number"
                                :content="formMachine.serNum"
                                title2="Nama"
                                :content2="formMachine.name"
                            />
                            <Data
                                title="Color"
                                :content="formMachine.color"
                                title2="Price"
                                :content2="formMachine.price"
                            />
                            <Data
                                title="Year Of Manufacture"
                                :content="formMachine.yom"
                            />
                        </tbody>
                    </table>
                </div>
            </div>
        </template>
        <template #footer>
            <div
                class="flex flex-row justify-center space-x-4 sm:pb-10 mt-2 mb-2"
            >
                <div
                    class="inline-flex rounded-md shadow-lg shadow-gray-300/40"
                    role="group"
                >
                    <button
                        type="button"
                        @click.prevent="modalEdit()"
                        class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-900 backdrop-blur-sm bg-white rounded-l-lg border-l border-gray-100 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-gray-100 focus:text-blue-700"
                    >
                        Edit
                    </button>
                    <button
                        type="button"
                        @click.prevent="deleteMachine()"
                        class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-900 backdrop-blur-sm bg-white border-r border-gray-100 rounded-r-md hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-2 focus:ring-gray-100 focus:text-red-700"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </template>
    </Modal>
</template>
