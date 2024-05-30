<script setup>
import {Link} from "@inertiajs/vue3";

let props = defineProps({
    links: Array,
});
</script>

<template>
    <div v-show="links.length > 3" class="flex justify-end">
        <div class="flex justify-self-end rounded-lg bg-white shadow-sm ring-1 ring-gray-950/10 dark:bg-white/5 dark:ring-white/20">
            <template v-for="(link, key) in links" :key="key">
                <div v-if="link.url === null" :key="`${key}-disabled`" class="mr-1 mb-1 px-2 py-1.5 text-sm leading-4 text-gray-400 rounded cursor-not-allowed" v-html="link.label"/>
                <Link v-else :key="key"
                      class="mr-1 mb-1 px-2 py-1.5 text-sm leading-4 rounded focus:outline-none focus:text-yellow-600 focus:ring-2 focus:ring-yellow-500"
                      :class="{ 'px-1.5 text-sm font-semibold text-amber-600 dark:text-amber-400': link.active, 'px-1.5 text-sm font-semibold text-gray-700 dark:text-gray-200': !link.active }"
                      :href="link.url">
                    <span v-html="link.label"></span>
                </Link>
            </template>
        </div>
    </div>
</template>
