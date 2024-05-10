<script setup>
import { ref } from 'vue';

const form = ref(true)
const openForm = () => { 
    if (form.value == false) {
        form.value == true;
    }
    else {
        form.value == false;
    }
} 
</script>

<template>
    <div class="w-full">
        <h2 @click.prevent="openForm()">
            <button type="button" :class="form ? 'text-blue-700' : 'text-gray-500 py-4'" class="font-bold uppercase text-sm flex items-center justify-between w-full pt-3">
                <span>
                    <slot name="title"></slot>    
                </span>
            </button>    
        </h2>    
    </div>    
</template>