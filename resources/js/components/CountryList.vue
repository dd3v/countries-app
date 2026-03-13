<template>
    <div class="flex flex-col flex-1 min-h-0">
        <div v-show="loading" class="flex justify-center py-16">
            <AppSpinner />
        </div>

        <div
            v-show="error"
            class="rounded-lg bg-red-50 dark:bg-red-950 p-6 text-red-600 dark:text-red-400"
        >
            {{ error }}
        </div>

        <div
            v-show="!loading && !error"
            class="flex flex-col min-h-0 flex-1 gap-6 overflow-hidden"
        >
            <input
                v-model="filterQuery"
                type="search"
                placeholder="Filter by country name..."
                class="w-full shrink-0 px-4 py-2 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 dark:placeholder-zinc-500 focus:outline-none"
            />
            <div class="overflow-y-auto flex-1 min-h-0">
                <div
                    v-if="filteredCountries.length"
                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4 md:gap-6 py-2 pb-8"
                >
                    <CountryCard
                        v-for="country in filteredCountries"
                        :key="country.name"
                        :name="country.name"
                        :flag-url="country.flag_url"
                    />
                </div>
                <p
                    v-else
                    class="py-8 text-center text-zinc-500 dark:text-zinc-400"
                >
                    No countries match your search
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import CountryCard from './CountryCard.vue';
import AppSpinner from './AppSpinner.vue';

const countries = ref([]);
const loading = ref(true);
const error = ref(null);
const filterQuery = ref('');

const filteredCountries = computed(() => {
    const query = filterQuery.value.trim().toLowerCase();
    if (!query) return countries.value;
    return countries.value.filter((c) =>
        c.name.toLowerCase().startsWith(query),
    );
});

onMounted(async () => {
    try {
        const { data } = await axios.get('/api/countries', {
            withCredentials: true,
        });
        countries.value = data.data ?? [];
    } catch (e) {
        error.value =
            e.response?.data?.message ??
            e.message ??
            'Failed to load countries';
    } finally {
        loading.value = false;
    }
});
</script>
