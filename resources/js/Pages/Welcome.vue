<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {useDark, useToggle} from '@vueuse/core';
import {ref, watch} from "vue";
import PdfShow from "@/Pages/Projects/PdfShow.vue";

const isDark = useDark();
const toggleDark = useToggle(isDark);

defineProps({
    projects: Object,
});

const isOpenProjectModal = ref(false);

const tempProject = ref(null);

const openTeamProjectsModal = (project) => {
    tempProject.value = project;
    isOpenProjectModal.value = true;
}

watch(isOpenProjectModal, () => {
    if (!isOpenProjectModal.value) {
        tempProject.value = null;
    }
});
</script>

<template>
    <Head title="Главная"/>

    <div class="bg-white dark:bg-gray-900">

        <header>
            <nav class="absolute z-10 w-full border-b border-black/5 dark:border-white/5 lg:border-transparent">
                <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
                    <div class="relative flex flex-wrap items-center justify-between gap-6 py-3 md:gap-0 md:py-4">
                        <div class="relative z-20 flex w-full justify-between md:px-0 lg:w-max">
                            <div class="flex items-center space-x-2">
                                <div aria-hidden="true" class="flex space-x-1">
                                    <div class="h-4 w-4 rounded-full bg-gray-900 dark:bg-white"></div>
                                    <div class="h-6 w-2 bg-primary"></div>
                                </div>
                                <span class="text-2xl font-bold text-gray-900 dark:text-white">Севгу</span>
                            </div>

                            <div class="relative flex max-h-10 items-center lg:hidden">
                                <button aria-label="humburger" id="hamburger" class="relative -mr-6 p-6">
                                    <div aria-hidden="true" id="line" class="m-auto h-0.5 w-5 rounded bg-sky-900 transition duration-300 dark:bg-gray-300"></div>
                                    <div aria-hidden="true" id="line2" class="m-auto mt-2 h-0.5 w-5 rounded bg-sky-900 transition duration-300 dark:bg-gray-300"></div>
                                </button>
                            </div>
                        </div>
                        <div id="navLayer" aria-hidden="true" class="fixed inset-0 z-10 h-screen w-screen origin-bottom scale-y-0 bg-white/70 backdrop-blur-2xl transition duration-500 dark:bg-gray-900/70 lg:hidden"></div>
                        <div id="navlinks" class="invisible absolute top-full left-0 z-20 w-full origin-top-right translate-y-1 scale-90 flex-col flex-wrap justify-end gap-6 rounded-3xl border border-gray-100 bg-white p-8 opacity-0 shadow-2xl shadow-gray-600/10 transition-all duration-300 dark:border-gray-700 dark:shadow-none lg:visible lg:relative lg:flex lg:w-7/12 lg:translate-y-0 lg:scale-100 lg:flex-row lg:items-center lg:gap-0 lg:border-none lg:bg-transparent lg:p-0 lg:opacity-100 lg:shadow-none">
                            <div class="mt-12 lg:mt-0">
                                <Link :href="route('login')" class="relative flex h-9 w-full items-center justify-center px-4 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max">
                                <span class="relative text-sm font-semibold dark:text-white">
                                    Вход
                                </span>
                                </Link>
                            </div>

                            <div class="mt-12 lg:mt-0">
                                <Link :href="route('register')" class="relative flex h-9 w-full items-center justify-center px-4 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max">
                                <span class="relative text-sm font-semibold dark:text-white">
                                    Регистрация
                                </span>
                                </Link>
                            </div>

                            <div class="grid grid-flow-col gap-x-1 p-1">
                                <button @click="toggleDark()" v-if="isDark" class="flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path d="M10 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 2ZM10 15a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 15ZM10 7a3 3 0 1 0 0 6 3 3 0 0 0 0-6ZM15.657 5.404a.75.75 0 1 0-1.06-1.06l-1.061 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM6.464 14.596a.75.75 0 1 0-1.06-1.06l-1.06 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM18 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 18 10ZM5 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 5 10ZM14.596 15.657a.75.75 0 0 0 1.06-1.06l-1.06-1.061a.75.75 0 1 0-1.06 1.06l1.06 1.06ZM5.404 6.464a.75.75 0 0 0 1.06-1.06l-1.06-1.06a.75.75 0 1 0-1.061 1.06l1.06 1.06Z"></path>
                                    </svg>
                                </button>

                                <button @click="toggleDark()" v-if="!isDark" class="flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M7.455 2.004a.75.75 0 0 1 .26.77 7 7 0 0 0 9.958 7.967.75.75 0 0 1 1.067.853A8.5 8.5 0 1 1 6.647 1.921a.75.75 0 0 1 .808.083Z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="space-y-40 mb-40">
            <div class="relative" id="home">
                <div aria-hidden="true" class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20">
                    <div
                        class="blur-[106px] h-56 bg-gradient-to-br from-primary to-purple-400 dark:from-blue-700"></div>
                    <div class="blur-[106px] h-32 bg-gradient-to-r from-cyan-400 to-sky-300 dark:to-indigo-600"></div>
                </div>
                <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
                    <div class="relative pt-72 ml-auto">
                        <div class="lg:w-2/3 text-center mx-auto">
                            <h1 class="text-gray-900 dark:text-white font-bold text-5xl md:text-6xl xl:text-7xl">
                                Направления
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <div id="blog">
                <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
                    <div class="mb-12 space-y-2 text-center">
                        <h2 class="text-3xl font-bold text-gray-800 md:text-4xl dark:text-white">
                            Проекты
                        </h2>
                    </div>
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

                        <div v-for="project in projects.data"
                             class="group p-6 sm:p-8 rounded-3xl bg-white border border-gray-100 dark:shadow-none dark:border-gray-700 dark:bg-gray-800 bg-opacity-50 shadow-2xl shadow-gray-600/10">
                            <div class="relative overflow-hidden rounded-xl">
                                <img :src="project.image_url" alt="art cover" loading="lazy" width="1000" height="667" class="h-64 w-full object-cover object-top transition duration-500 group-hover:scale-105">
                            </div>
                            <div class="mt-6 relative">
                                <h3 class="text-2xl font-semibold text-gray-800 dark:text-white">
                                    {{ project.title }}
                                </h3>
                                <p class="mt-6 mb-8 text-gray-600 dark:text-gray-300">
                                    {{ project.description }}
                                </p>
                                <button @click="openTeamProjectsModal(project)" class="relative inline-flex items-center justify-center outline-none hover:underline decoration-amber-600 dark:decoration-amber-400 cursor-pointer">
                                    <span class="font-semibold text-sm text-amber-600 dark:text-amber-400">
                                        Подробнее
                                    </span>
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </main>

        <footer class="py-20 md:py-40">
            <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
                <div class="m-auto md:w-10/12 lg:w-8/12 xl:w-6/12">
                    <div class="flex flex-wrap items-center justify-between md:flex-nowrap">
                        <div class="flex w-full justify-center space-x-12 text-gray-600 dark:text-gray-300">
                            <ul class="list-inside list-disc space-y-8">
                                <li>
                                    <a href="#" class="transition hover:text-primary">
                                        1
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="transition hover:text-primary">
                                        2
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <div v-if="isOpenProjectModal">
        <div class="fixed inset-0 z-40 bg-gray-950/50 dark:bg-zinc-950/75" aria-hidden="true" x-transition.duration.300ms.opacity>
            <div class="fixed inset-0 z-40 overflow-y-auto cursor-pointer">
                <div class="relative grid min-h-full grid-rows-[1fr_auto_1fr] justify-items-center sm:grid-rows-[1fr_auto_3fr] p-4">

                    <div class="pointer-events-auto relative row-start-2 flex w-full cursor-default flex-col bg-white shadow-xl ring-1 ring-gray-950/5 dark:bg-zinc-900 dark:ring-white/10 mx-auto rounded-xl max-w-7xl">
                        <div class="flex px-6 pt-6 gap-x-5 w-full">
                            <div class="absolute end-4 top-4">
                                <button @click="isOpenProjectModal = false" class="relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 disabled:pointer-events-none disabled:opacity-70 -m-1.5 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500" title="Close" type="button" tabindex="-1">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="w-full">
                                <h2 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                    Проект "{{ tempProject.title }}"
                                </h2>

                                <div class="flex justify-center">
                                    <div v-if="tempProject.image_url" class="relative overflow-hidden rounded-xl">
                                        <img :src="tempProject.image_url" alt="art cover" loading="lazy" class="h-72 w-full object-cover object-top transition duration-500 group-hover:scale-105">
                                    </div>
                                </div>

                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                    <div class="relative inline-flex items-center justify-center outline-none">
                                        {{ tempProject.description }}
                                    </div>
                                </div>

                                <div class="flex justify-center">
                                    <div v-if="tempProject.pdf_url" class="mt-3 w-full text-gray-600 dark:text-gray-400">
                                        <PdfShow :pdfUrl="tempProject.pdf_url" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-4 py-6 px-6">

                        </div>

                        <div class="w-full px-6 pb-6">
                            <div class="gap-3 flex flex-wrap items-center">
                                <div class="gap-3 flex flex-wrap items-center justify-start shrink-0 sm:mt-7">
                                    <button @click="isOpenProjectModal = false" class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-amber-600 text-white hover:bg-amber-500 focus-visible:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus-visible:ring-amber-400/50">
                                        <span class="">Закрыть</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>
