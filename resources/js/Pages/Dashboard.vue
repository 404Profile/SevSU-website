<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {ref, watch} from "vue";
import { router, Link } from '@inertiajs/vue3';

let props = defineProps({
    authUserTeams: Object,
})

const isOpenChangeTeamModal = ref(false);
const isOpenTeamProjectsModal = ref(false);

const tempTeam = ref(null);

const openTeamProjectsModal = (team) => {
    tempTeam.value = team;
    isOpenTeamProjectsModal.value = true;
}

watch(isOpenTeamProjectsModal, () => {
    if (!isOpenTeamProjectsModal.value) {
        tempTeam.value = null;
    }
});

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};
</script>

<template>
    <AppLayout title="Приборная панель">
            <section class="flex flex-col gap-y-8 py-8">

                <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                            Приборная панель
                        </h1>
                    </div>
                    <div class="gap-3 flex flex-wrap items-center justify-start shrink-0 sm:mt-7">
                        <button @click="isOpenChangeTeamModal = true" class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-amber-600 text-white hover:bg-amber-500 focus-visible:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus-visible:ring-amber-400/50">
                            <span>Сменить команду</span>
                        </button>
                    </div>
                </header>

                <div v-if="authUserTeams.length > 0">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center pb-5">
                        <div class="grid gap-y-1">
                            <h3 class="heading text-xl font-semibold leading-6 text-gray-950 dark:text-white">
                                Команды, к которым Вы имеете отношение
                            </h3>
                        </div>
                    </div>

                    <div v-for="team in authUserTeams" class="rounded-xl bg-white shadow-sm text-base ring-1 ring-zinc-950/5 dark:bg-zinc-900 dark:ring-white/10 p-6 flex items-center gap-x-3 sm:justify-between">
                        <div>
                            <div class="text-xl">
                                <p>{{ team.name }}</p>
                            </div>
                            <div class="text-base">
                                <p>Владелец: {{ team.owner.name }}</p>
                            </div>
                        </div>

                        <div class="">
                            <p>Количество участников:</p>
                            <p>{{ team.users.length + 1 }}</p>
                        </div>

                        <div class="">
                            <p>Количество проектов:</p>
                            <p>{{ team.project.length }}</p>

                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                <button @click="openTeamProjectsModal(team)" class="relative inline-flex items-center justify-center outline-none hover:underline decoration-amber-600 dark:decoration-amber-400 cursor-pointer">
                                    <span class="font-semibold text-sm text-amber-600 dark:text-amber-400">
                                        Посмотреть проекты
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else>
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div class="grid gap-y-1">
                            <h3 class="heading text-xl font-semibold leading-6 text-gray-950 dark:text-white">
                                У Вас нет команд, к которым Вы относитесь
                            </h3>
                        </div>
                    </div>
                </div>

            </section>

        <div v-if="isOpenChangeTeamModal">
            <div class="fixed inset-0 z-40 bg-gray-950/50 dark:bg-zinc-950/75" aria-hidden="true" x-transition.duration.300ms.opacity>
                <div class="fixed inset-0 z-40 overflow-y-auto cursor-pointer">
                    <div class="relative grid min-h-full grid-rows-[1fr_auto_1fr] justify-items-center sm:grid-rows-[1fr_auto_3fr] p-4">

                        <div class="pointer-events-auto relative row-start-2 flex w-full cursor-default flex-col bg-white shadow-xl ring-1 ring-gray-950/5 dark:bg-zinc-900 dark:ring-white/10 mx-auto rounded-xl max-w-xl">
                            <div class="flex px-6 pt-6 gap-x-5">
                                <div class="absolute end-4 top-4">
                                    <button @click="isOpenChangeTeamModal = false" class="relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 disabled:pointer-events-none disabled:opacity-70 -m-1.5 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500" title="Close" type="button" tabindex="-1">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <div class="">
                                    <h2 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                        Выберите команду
                                    </h2>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                        <div class="relative inline-flex items-center justify-center outline-none">
                                            <span class="font-semibold text-sm text-amber-600 dark:text-amber-400">
                                                Выберите нужныю команду, от имени которой вы хотите выполнять действия
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-y-4 py-6 px-6">
                                <div v-if="$page.props.auth.user.all_teams.length > 1">
                                    <div v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                        <form @submit.prevent="switchToTeam(team)">
                                            <button class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5 focus:outline-none focus:bg-gray-100 dark:focus:bg-white/5 transition duration-150 ease-in-out cursor-pointer rounded-md">
                                                <div class="flex items-center text-base">
                                                    <svg v-if="team.id === $page.props.auth.user.current_team_id" class="me-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>

                                                    <div>{{ team.name }}</div>
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div v-else class="flex items-center">
                                    <svg class="me-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>{{ $page.props.auth.user.current_team.name }}</div>
                                </div>
                            </div>

                            <div class="w-full px-6 pb-6">
                                <div class="gap-3 flex flex-wrap items-center">
                                    <div class="gap-3 flex flex-wrap items-center justify-start shrink-0 sm:mt-7">
                                        <button @click="isOpenChangeTeamModal = false" class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-amber-600 text-white hover:bg-amber-500 focus-visible:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus-visible:ring-amber-400/50">
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

        <div v-if="isOpenTeamProjectsModal">
            <div class="fixed inset-0 z-40 bg-gray-950/50 dark:bg-zinc-950/75" aria-hidden="true" x-transition.duration.300ms.opacity>
                <div class="fixed inset-0 z-40 overflow-y-auto cursor-pointer">
                    <div class="relative grid min-h-full grid-rows-[1fr_auto_1fr] justify-items-center sm:grid-rows-[1fr_auto_3fr] p-4">

                        <div class="pointer-events-auto relative row-start-2 flex w-full cursor-default flex-col bg-white shadow-xl ring-1 ring-gray-950/5 dark:bg-zinc-900 dark:ring-white/10 mx-auto rounded-xl max-w-xl">
                            <div class="flex px-6 pt-6 gap-x-5">
                                <div class="absolute end-4 top-4">
                                    <button @click="isOpenTeamProjectsModal = false" class="relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 disabled:pointer-events-none disabled:opacity-70 -m-1.5 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500" title="Close" type="button" tabindex="-1">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <div class="">
                                    <h2 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                        Проекты команды {{ tempTeam.name }}
                                    </h2>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                        <div class="relative inline-flex items-center justify-center outline-none">
                                            <span class="font-semibold text-sm text-amber-600 dark:text-amber-400">
                                                Ниже можно увидеть название всех проектов команды и перейти к ним
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-y-4 py-6 px-6">
                                <div v-for="project in tempTeam.project" class="flex justify-between border border-zinc-800 rounded-md p-1 px-3">
                                    <div>{{ project.title }}</div>
                                    <Link :href="route('projects.show', project.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </Link>
                                </div>
                            </div>

                            <div class="w-full px-6 pb-6">
                                <div class="gap-3 flex flex-wrap items-center">
                                    <div class="gap-3 flex flex-wrap items-center justify-start shrink-0 sm:mt-7">
                                        <button @click="isOpenTeamProjectsModal = false" class="relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-amber-600 text-white hover:bg-amber-500 focus-visible:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus-visible:ring-amber-400/50">
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
    </AppLayout>
</template>
