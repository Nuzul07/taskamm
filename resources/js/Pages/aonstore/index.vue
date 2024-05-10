<script setup>
import AonLayout from '@/Layouts/AonLayout.vue';
import Card from '@/Components/Card.vue';
import ResNav from '@/Components/ResponsiveNavLink.vue';
import NavLink from '@/Components/NavLink.vue';
import Foot from '@/Components/Footer.vue';
import axios from "axios";
import { ref, onMounted, watch } from "vue";

onMounted(() => {
    getMachine()
});

const machine = ref({})

const getMachine = () => {
    machine.value = {};
    axios
        .get(route("machine.index"))
        .then((res) => {
            const data = res.data;
            machine.value = data;
        })
        .catch((err) => {
            alert(`Fail to load data \n\nError: ${err}`);
        });
};
</script>

<template>
    <Head title="AON" />

    <AonLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-thight text-center">HAPPY SHOPPING</h2>
        </template>

        <template #content>
            <div class="py-12 bg-green-400">
                <div class="pb-12">
                    <img class="object-cover h-96 m-auto w-full rounded-sm" src="https://flowbite.s3.amazonaws.com/docs/gallery/featured/image.jpg" alt="">
                </div>
                <div class="w-full m-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 gap-3 px-4 sm:grid-cols-2 sm:gap-4 lg:grid-cols-4 lg:gap-5">
                        <div class="h-56 bg-emerald-300 sm:w-full rounded-lg" v-for="(data, index) in machine" :key="index">
                            <h2>{{ data.name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-24">
            <Foot nav1="About" nav2="Privacy Policy" nav3="Contact" nav4="Licensing"></Foot>
            </div>
        </template>
    </AonLayout>
</template>