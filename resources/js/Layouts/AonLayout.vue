<script setup>
import { ref } from "vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import { Link } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import Search from "@/Components/SearchInput.vue";
</script>

<template>
    <div class="min-h-screen bg-white">
        <nav class="sticky top-0 bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex space-x-16">
                        <NavLink>Dashboard</NavLink>
                        <NavLink>Elektronik</NavLink>
                    </div>
                    <div>
                        <Search></Search>
                    </div>
                    <div class="hidden sm:-my-px sm:ms-10 sm:flex">
                        <NavLink>AON STORE</NavLink>
                    </div>
                </div>
            </div>
        </nav>
        <header class="bg-emerald-600 shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main v-if="$slots.content">
            <slot name="content" />
        </main>
    </div>
</template>
