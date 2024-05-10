<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, onMounted, watch} from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

onMounted(()=>{ getMachince() })


const loadingSec = ref(false)
const machine = ref ({})
const getMachince = () => {
    machine.value = {}
    loadingSec.value = true
    axios.get(route("machine.index")).then(res=>{
        const data  = res.data
        machine.value = data
        loadingSec.value = false
    }).catch(err=>{
            alert(`Failed to load data\n\nError: ${err}`)
    })
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="container mx-auto">
                        <table class="auto">
                            <thead class="bg-black-500 text-white">
                                <tr>
                                    <td class="px-3 py-2 font-bold w-5">No.</td>
                                    <td class="px-3 py-2 font-bold">Serial Number</td>
                                    <td class="px-3 py-2 font-bold">Nama</td>    
                                    <td class="px-3 py-2 font-bold">Warna</td>
                                    <td class="px-3 py-2 font-bold">Harga</td>
                                    <td class="px-3 py-2 font-bold">Tahun Pembuatan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data,index) in machine.data" :key="index" class="even:bg-blue-50 hover:bg-blue-100">
                                    <td class="px-3 py-2">{{ index+1 }}</td>
                                    <td class="px-3 py-2">{{ data.serNum }}</td>    
                                    <td class="px-3 py-2">{{ data.nama }}</td>
                                    <td class="px-3 py-2">{{ data.warna }}</td>
                                    <td class="px-3 py-2">{{ data.harga }}</td>
                                    <td class="px-3 py-2">{{ data.yom }}</td>
                                </tr>    
                                <tr v-if="loadingSec">
                                    <td colspan="3" class="px-2 py-1 text-center font-bold">Mohon Tunggu</td>    
                                </tr>
                                <tr v-else-if="machine && (!machine.data || (machine.data && machine.data.length <= 0))">
                                    <td colspan="3" class="px-2 py-1 text-center font-bold">Tidak Ada Data</td>    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
