<script setup>
const props = defineProps(['title', 'content', 'title2', 'content2', 'content3', 'content', 'clsc3', 'clscstm', 'custom2']);
</script>

<template>
    <tr class="overflow-x-auto bg-transparent leading-relaxed" :class="clscstm">
        <th class="whitespace-nowrap" v-if="title">
            {{ title }}
        </th>
        <td class="p-2.5" v-if="title || content">
            :
        </td>
        <td class="whitespace-break-spaces text -left" v-if="content">
            {{ content }}
        </td>
        <td class="whitespace-break-spaces text-left text-white" v-if="content">
            &nbsp;
        </td>
        <th class="whitespace-nowrap" v-if="title2">
            {{ title2 }}
        </th>
        <td class="p-2.5" v-if="title2">
            :
        </td>
        <td class="whitespace-break-spaces text-left" v-if="content2">
            <div class="flex flex-row justify-left">
                <template v-if="custom2 == 'true'">
                    <span :class="clsc3">{{ content2 }}</span>
                </template>
                <template v-else>
                    <span>{{ content2 }}</span>
                </template>
            </div>
        </td>
    </tr>
</template>