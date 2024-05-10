<script setup>
const props = defineProps(["nav1","nav2","nav3","nav4"]);
</script>
<template>
    <footer class="bg-green-600 rounded-sm shadow dark:bg-gray-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span
                class="text-sm text-black sm:text-center dark:text-black"
                >© 2024
                <a href="https://flowbite.com/" class="hover:underline"
                    >AON</a
                >. All Rights Reserved.
            </span>
            <ul
                class="flex flex-wrap items-center mt-3 text-sm font-medium text-black dark:text-gray-400 sm:mt-0"
            >
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">{{ nav1 }}</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6"
                        >{{ nav2 }}</a
                    >
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6"
                        >{{ nav3 }}</a
                    >
                </li>
                <li>
                    <a href="#" class="hover:underline">{{ nav4 }}</a>
                </li>
            </ul>
        </div>
    </footer>
</template>
