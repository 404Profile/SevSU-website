<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { useDark, useToggle } from '@vueuse/core';

defineProps({
    title: String,
});

const isDark = useDark();
const toggleDark = useToggle(isDark);

const showingNavigationMenu = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100 dark:bg-zinc-950 text-gray-950 dark:text-gray-100 antialiased">

            <div class="flex gap-0 text-white text-sm leading-6 bg-stripes-pink rounded-lg w-full">
                <div class="fixed inset-y-0 start-0 z-30 flex flex-col h-screen content-start bg-white transition-all dark:bg-zinc-900 lg:z-0 lg:bg-transparent lg:shadow-none lg:ring-0 lg:transition-none dark:lg:bg-transparent lg:translate-x-0 rtl:lg:-translate-x-0 fi-main-sidebar w-[20rem] -translate-x-full rtl:translate-x-full lg:sticky">
                    <div class="flex-none w-[20rem] h-16 lg:block hidden">
                        <div class="overflow-x-clip w-full">
                            <header class="w-full flex h-16 items-center bg-white px-6 dark:bg-zinc-900 dark:ring-white/10 lg:shadow-sm">
                                <Link :href="route('welcome')">
                                    <img :src="$page.props.logo" class="h-10 w-auto">
                                </Link>
                            </header>
                        </div>
                        <nav class="flex-grow flex flex-col gap-y-7 overflow-y-auto overflow-x-hidden px-6 min-h-screen -mt-16 pt-24 shadow dark:border-r dark:border-zinc-900">
                            <ul class="-mx-2 flex flex-col gap-y-7">
                                <li class="flex flex-col gap-y-1">
                                    <ul class="flex flex-col gap-y-1">

                                        <li>
                                            <Link :href="route('dashboard')" class="relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                                <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                                </svg>
                                                <span class="flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200">
                                                    Приборная панель
                                                </span>
                                            </Link>
                                        </li>

                                        <li>
                                            <Link :href="route('projects.index')" class="relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                                <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                                </svg>
                                                <span class="flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200">
                                                    Проекты
                                                </span>
                                            </Link>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="flex-1 relative">
                    <div class="sticky top-0 z-20">
                        <div>
                            <nav class="flex h-16 items-center gap-x-4 bg-white px-4 shadow-sm dark:bg-zinc-900 dark:ring-white/10 md:px-6 lg:px-8 w-full">
                                <button @click="showingNavigationMenu = true" class="relative flex items-center justify-center rounded-lg cursor-pointer outline-none transition duration-75 focus-visible:ring-2 -m-1.5 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-amber-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-amber-500 lg:hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                    </svg>
                                </button>
                                <div class="ms-auto flex items-center gap-x-4 justify-end w-full">

                                    <div class="ms-3 relative">
                                        <!-- Teams Dropdown -->
                                        <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                                            <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-zinc-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-zinc-700 active:bg-gray-50 dark:active:bg-zinc-800 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.current_team.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                            </template>

                                            <template #content>
                                                <div class="w-60">
                                                    <!-- Team Management -->
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        Управление командой
                                                    </div>

                                                    <!-- Team Settings -->
                                                    <DropdownLink :href="route('teams.show', $page.props.auth.user.current_team)">
                                                        Настройки команды
                                                    </DropdownLink>

                                                    <DropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">
                                                        Создать новую команду
                                                    </DropdownLink>

                                                </div>
                                            </template>
                                        </Dropdown>
                                    </div>

                                    <!-- Settings Dropdown -->
                                    <div class="ms-3 relative">
                                        <Dropdown align="right" width="52">
                                            <template #trigger>
                                                <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                                </button>

                                                <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                            </template>

                                            <template #content>
                                                <div class="w-52">
                                                    <!-- Account Management -->
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        Управление учетной записью
                                                    </div>

                                                    <DropdownLink :href="route('profile.show')">
                                                        Профиль
                                                    </DropdownLink>

                                                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                                        Токены API
                                                    </DropdownLink>

                                                    <div class="border-t border-gray-200 dark:border-zinc-700" />

                                                    <div class="grid grid-flow-col gap-x-1 p-1">
                                                        <button v-if="!isDark" class="flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 fi-active bg-gray-50 text-amber-500 dark:bg-white/5 dark:text-amber-400">
                                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                                <path d="M10 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 2ZM10 15a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 15ZM10 7a3 3 0 1 0 0 6 3 3 0 0 0 0-6ZM15.657 5.404a.75.75 0 1 0-1.06-1.06l-1.061 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM6.464 14.596a.75.75 0 1 0-1.06-1.06l-1.06 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM18 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 18 10ZM5 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 5 10ZM14.596 15.657a.75.75 0 0 0 1.06-1.06l-1.06-1.061a.75.75 0 1 0-1.06 1.06l1.06 1.06ZM5.404 6.464a.75.75 0 0 0 1.06-1.06l-1.06-1.06a.75.75 0 1 0-1.061 1.06l1.06 1.06Z"></path>
                                                            </svg>
                                                        </button>

                                                        <button @click="toggleDark()" v-if="!isDark" class="flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400">
                                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                                <path fill-rule="evenodd" d="M7.455 2.004a.75.75 0 0 1 .26.77 7 7 0 0 0 9.958 7.967.75.75 0 0 1 1.067.853A8.5 8.5 0 1 1 6.647 1.921a.75.75 0 0 1 .808.083Z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>

                                                        <button @click="toggleDark()" v-if="isDark" class="flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400">
                                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                                <path d="M10 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 2ZM10 15a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 15ZM10 7a3 3 0 1 0 0 6 3 3 0 0 0 0-6ZM15.657 5.404a.75.75 0 1 0-1.06-1.06l-1.061 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM6.464 14.596a.75.75 0 1 0-1.06-1.06l-1.06 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM18 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 18 10ZM5 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 5 10ZM14.596 15.657a.75.75 0 0 0 1.06-1.06l-1.06-1.061a.75.75 0 1 0-1.06 1.06l1.06 1.06ZM5.404 6.464a.75.75 0 0 0 1.06-1.06l-1.06-1.06a.75.75 0 1 0-1.061 1.06l1.06 1.06Z"></path>
                                                            </svg>
                                                        </button>

                                                        <button v-if="isDark" class="flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 fi-active bg-gray-50 text-amber-500 dark:bg-white/5 dark:text-amber-400">
                                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                                <path fill-rule="evenodd" d="M7.455 2.004a.75.75 0 0 1 .26.77 7 7 0 0 0 9.958 7.967.75.75 0 0 1 1.067.853A8.5 8.5 0 1 1 6.647 1.921a.75.75 0 0 1 .808.083Z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="border-t border-gray-200 dark:border-zinc-700" />

                                                    <!-- Authentication -->
                                                    <form @submit.prevent="logout">
                                                        <DropdownLink as="button">
                                                            <div class="flex">
                                                                <svg class="h-5 w-5 text-gray-400 dark:text-gray-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                                    <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd"></path>
                                                                    <path fill-rule="evenodd" d="M19 10a.75.75 0 0 0-.75-.75H8.704l1.048-.943a.75.75 0 1 0-1.004-1.114l-2.5 2.25a.75.75 0 0 0 0 1.114l2.5 2.25a.75.75 0 1 0 1.004-1.114l-1.048-.943h9.546A.75.75 0 0 0 19 10Z" clip-rule="evenodd"></path>
                                                                </svg>
                                                                Выход
                                                            </div>
                                                        </DropdownLink>
                                                    </form>
                                                </div>
                                            </template>
                                        </Dropdown>
                                    </div>

                                </div>
                            </nav>
                        </div>
                    </div>

                    <main class="mx-auto w-full px-4 md:px-6 lg:px-8 max-w-7xl text-gray-900 dark:text-gray-100">
                        <slot />
                    </main>

                </div>
            </div>

        </div>

        <div v-if="showingNavigationMenu" class="fixed inset-0 z-30">
            <div @click="showingNavigationMenu = false" class="fixed inset-0 z-30 bg-zinc-950/50 transition duration-500 dark:bg-zinc-950/75 lg:hidden"></div>
            <aside class="fixed inset-y-0 start-0 z-30 flex flex-col h-screen content-start bg-white transition-all dark:bg-zinc-900 lg:z-0 lg:bg-transparent lg:shadow-none lg:ring-0 lg:transition-none dark:lg:bg-transparent lg:translate-x-0 rtl:lg:-translate-x-0 w-[20rem] translate-x-0 shadow-xl ring-1 ring-gray-950/5 dark:ring-white/10 rtl:-translate-x-0 lg:sticky">
                <div class="overflow-x-clip">
                    <header class="w-full flex h-16 items-center bg-white ring-1 ring-gray-950/5 px-6 dark:bg-zinc-900 dark:ring-white/10 shadow-sm">
                        <div>
                            Логотип
                        </div>
                    </header>
                </div>

                <nav class="flex-grow flex flex-col gap-y-7 overflow-y-auto overflow-x-hidden px-6 min-h-screen -mt-16 pt-24 border-r border-zinc-900">
                    <ul class="-mx-2 flex flex-col gap-y-7">
                        <li class="flex flex-col gap-y-1">
                            <ul class="flex flex-col gap-y-1">

                                <li>
                                    <Link :href="route('dashboard')" class="relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                        <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                        </svg>
                                        <span class="flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200">
                                            Приборная панель
                                        </span>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('projects.index')" class="relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
                                        <svg class="h-6 w-6 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                        </svg>
                                        <span class="flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200">
                                            Проекты
                                        </span>
                                    </Link>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>
            </aside>
        </div>

    </div>
</template>
