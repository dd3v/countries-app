<template>
    <div
        class="flex flex-col items-center p-3 sm:p-4 rounded-lg bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 hover:shadow-md transition-shadow min-w-0"
    >
        <img
            v-if="!imgError"
            :src="flagUrl"
            :alt="`Flag of ${name}`"
            class="w-full aspect-video object-cover rounded mb-2 sm:mb-3"
            loading="lazy"
            @error="imgError = true"
        />
        <div
            v-else
            class="w-full aspect-video rounded mb-2 sm:mb-3 bg-zinc-100 dark:bg-zinc-800"
        />
        <h2
            class="text-xs sm:text-sm font-medium text-zinc-900 dark:text-zinc-100 text-center line-clamp-2 break-words w-full"
        >
            {{ name }}
        </h2>
    </div>
</template>

<script setup>
import { ref } from 'vue';

defineProps({
    name: {
        type: String,
        required: true,
    },
    flagUrl: {
        type: String,
        required: true,
    },
});

const imgError = ref(false);
</script>
