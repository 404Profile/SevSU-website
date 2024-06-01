<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PdfShow from "@/Pages/Projects/PdfShow.vue";

let props = defineProps({
    project: Object,
})
</script>

<template>
    <AppLayout title="Просмотр проекта">
        <section class="flex flex-col gap-y-8 py-8">

            <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
                        Проект "{{ project.title }}"
                    </h1>
                </div>
            </header>

            <div>
                <div class="grid flex-1 auto-cols-fr gap-y-8">
                    <div class="flex flex-col gap-y-6">
                        <div class="divide-y divide-zinc-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-zinc-950/5 dark:divide-white/10 dark:bg-zinc-900 dark:ring-white/10">
                            <div class="divide-y divide-zinc-200 dark:divide-white/10">
                                <div class="block items-center justify-between gap-x-4 px-4 py-3 sm:px-6">
                                    <div class="p-2">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            Проект от команды "{{ project.team.name }}"
                                        </h3>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            Группа - <span class="mt-3 w-full text-gray-600 dark:text-gray-400">{{ project.group }}</span>
                                        </h3>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            Описание проекта
                                        </h3>
                                        <div class="mt-3 w-full text-gray-600 dark:text-gray-400">
                                            <p>
                                                {{ project.description }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            Изображение
                                        </h3>
                                        <div v-if="project.image_url" class="flex justify-center mt-3 w-full text-gray-600 dark:text-gray-400">
                                            <img :src="project.image_url" class="w-auto h-[300px]" alt="404" />
                                        </div>
                                        <div v-else>
                                            <p>Отсутствует</p>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            Презентация
                                        </h3>
                                        <div v-if="project.pdf_url" class="mt-3 w-full text-gray-600 dark:text-gray-400">
                                            <PdfShow :pdfUrl="project.pdf_url" />
                                        </div>
                                        <div v-else>
                                            <p>Отсутствует</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </AppLayout>
</template>
