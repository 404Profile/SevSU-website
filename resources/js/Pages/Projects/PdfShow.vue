<script setup>
import { ref } from 'vue';
import { VuePDF, usePDF } from '@tato30/vue-pdf';

const props = defineProps({
    pdfUrl: String,
});

const page = ref(1)
const { pdf, pages } = usePDF(props.pdfUrl)
</script>

<template>
    <div class="w-full flex justify-center">
        <VuePDF :pdf="pdf" :page="page" />
    </div>
    <div class="flex justify-center space-x-2 pt-3">
        <div @click="page = page > 1 ? page - 1 : page" class="cursor-pointer flex flex-wrap items-center justify-start shrink-0">
            <p class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-amber-600 text-white hover:bg-amber-500 focus-visible:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus-visible:ring-amber-400/50">
                <span class="select-none">Назад</span>
            </p>
        </div>
        <span class="flex items-center">{{ page }} / {{ pages }}</span>
        <div @click="page = page < pages ? page + 1 : page" class="cursor-pointer flex flex-wrap items-center justify-start shrink-0">
            <p class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-amber-600 text-white hover:bg-amber-500 focus-visible:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus-visible:ring-amber-400/50">
                <span class="select-none">Вперед</span>
            </p>
        </div>
    </div>
</template>
