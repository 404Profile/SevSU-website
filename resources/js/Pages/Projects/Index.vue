<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import {Link, router} from "@inertiajs/vue3";
import Pagination from '@/Components/Pagination.vue';
import {ref, watch} from "vue";

let props = defineProps({
    projects: Object,
    filters: Object,
});

const search = ref(props.filters.search);

watch(search, value => {
    router.get('/projects', { search: search.value }, {
        preserveState: true,
        replace: true,
    })
});

const deleteProject = (id) => {
    if(confirm('Вы уверены, что хотите удалить этот проект?')) {
        console.log(id)
        router.delete(route('projects.destroy', id), {
            preserveScroll: true,
        })
    }
}
</script>

<template>
    <AppLayout title="Проекты">
        <section class="flex flex-col gap-y-8 py-8">

            <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                        Проекты
                    </h1>
                </div>
                <div class="gap-3 flex flex-wrap items-center justify-start shrink-0 sm:mt-7">
                    <Link :href="route('projects.create')" class="bg-custom-blue relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm text-white focus-visible:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus-visible:ring-amber-400/50">
                        Создать новый проект
                    </Link>
                </div>
            </header>

            <div>
                <div class="grid flex-1 auto-cols-fr gap-y-8">
                    <div class="flex flex-col gap-y-6">
                        <div class="divide-y divide-zinc-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-zinc-950/5 dark:divide-white/10 dark:bg-zinc-900 dark:ring-white/10">
                            <div class="divide-y divide-zinc-200 dark:divide-white/10">
                                <div class="flex items-center justify-between gap-x-4 px-4 py-3 sm:px-6">

                                    <div class="ms-auto flex items-center gap-x-4">
                                        <div>
                                            <label class="sr-only" for="search">
                                                Поиск
                                            </label>

                                            <div class="flex rounded-lg shadow-sm ring-1 dark:ring-white/20 focus:ring-amber-600 dark:focus:ring-amber-500 transition duration-75 bg-white dark:bg-white/5">
                                                <div class="items-center gap-x-3 ps-3 flex pe-2">
                                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <input v-model="search" placeholder="Поиск" type="search" id="search" class="block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 dark:text-white dark:placeholder:text-gray-500 sm:text-sm sm:leading-6 bg-white/0 ps-0 pe-3" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
                                    <table class="w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                                        <thead class="divide-y divide-gray-200 dark:divide-white/5">
                                        <tr class="bg-gray-50 dark:bg-white/5">
                                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                                <div class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                                    <span class="text-sm font-semibold text-gray-950 dark:text-white">
                                                        Название
                                                    </span>
                                                </div>
                                            </th>
                                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 w-60">
                                                <div class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                                    <span class="text-sm font-semibold text-gray-950 dark:text-white">
                                                        Изображение
                                                    </span>
                                                </div>
                                            </th>
                                            <th class="px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 w-60">
                                                <div class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                                    <span class="text-sm font-semibold text-gray-950 dark:text-white">
                                                        Презентация
                                                    </span>
                                                </div>
                                            </th>
                                            <th class="w-1"></th>
                                        </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                                        <tr v-if="projects.data.length === 0 && search" class="hover:bg-gray-50 dark:hover:bg-white/5">
                                            <td>
                                                <p class="text-center py-2 text-base">
                                                    По вашему запросу ничего не найдено
                                                </p>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr v-else-if="projects.data.length === 0 && !search" class="hover:bg-gray-50 dark:hover:bg-white/5">
                                            <td>
                                                <p class="text-center py-2 text-base">
                                                    Записей нет
                                                </p>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr v-for="(project, index) in projects.data" :key="project.id" class="hover:bg-gray-50 dark:hover:bg-white/5">
                                            <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                                {{ project.title }}
                                            </td>

                                            <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                                <div class="fi-ta-col-wrp">
                                                    <div class="px-3 py-4 flex w-full disabled:pointer-events-none justify-start text-start">
                                                        <div class="flex items-center gap-x-2.5">
                                                            <div v-if="project.image_url" class="flex gap-1.5">
                                                                <img :src="project.image_url" style="height: 2.5rem;" class="max-w-none object-cover object-center ring-white dark:ring-gray-900">
                                                            </div>
                                                            <div v-else>
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-500 size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                                <div class="fi-ta-col-wrp">
                                                    <div class="px-3 py-4 flex w-full disabled:pointer-events-none justify-start text-start">
                                                        <div class="flex items-center gap-x-2.5">
                                                            <div v-if="project.pdf_url" class="flex gap-1.5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-green-500 size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                                </svg>
                                                            </div>
                                                            <div v-else>
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-500 size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                                                <div class="whitespace-nowrap px-3 py-4">
                                                    <div class="flex shrink-0 items-center gap-3 justify-end">
                                                        <Link :href="route('projects.show', project.id)">
                                                            <div class="w-4">
                                                                <svg class="h-4 w-4 text-green-600 hover:text-green-400 dark:text-green-400 dark:hover:text-green-600 hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                </svg>
                                                            </div>
                                                        </Link>
                                                        <Link :href="route('projects.edit', project.id)" class="cursor-pointer relative inline-flex items-center justify-center outline-none gap-1">
                                                            <svg class="h-4 w-4 text-amber-600 hover:text-amber-400 dark:text-amber-400 dark:hover:text-amber-600 hover:scale-110" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                                <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z"></path>
                                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z"></path>
                                                            </svg>
                                                        </Link>
                                                        <button @click="deleteProject(project.id)">
                                                            <div class="w-4">
                                                                <svg type="submit" class="w-4 mr-2 transform hover:text-red-600 hover:scale-110" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <Pagination class="p-3" :links="projects.links"/>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </AppLayout>
</template>

<style>
.bg-custom-blue {
    background-color: rgba(39, 52, 139, 1);
}
</style>
