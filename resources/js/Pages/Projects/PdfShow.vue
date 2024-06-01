<script setup>
import { ref } from 'vue';
import { VuePDF, usePDF } from '@tato30/vue-pdf';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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
        <PrimaryButton @click="page = page > 1 ? page - 1 : page">
            Назад
        </PrimaryButton>
        <span class="flex items-center">{{ page }} / {{ pages }}</span>
        <PrimaryButton @click="page = page < pages ? page + 1 : page">
            Вперед
        </PrimaryButton>
    </div>
</template>
