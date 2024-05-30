<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import {useForm, router, Link} from "@inertiajs/vue3";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {onMounted, onUnmounted, ref, watch} from "vue";
import PdfShow from "@/Pages/Projects/PdfShow.vue";

const props = defineProps({
    project: Object,
    filters: Object,
});

const form = useForm({
    title: props.project.title,
    description: props.project.description,
});

const editProject = () => {
    form.patch(route('projects.update', props.project.id), {
        preserveScroll: true,
    })
}
</script>

<template>
    <AppLayout title="Редактировать тэг">
        <section class="flex flex-col gap-y-8 py-8">

            <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                        Редактировать проект
                    </h1>
                </div>
            </header>

            <div>
                <div class="grid flex-1 auto-cols-fr gap-y-8">
                    <div class="flex flex-col gap-y-6">
                        <div class="divide-y divide-zinc-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-zinc-950/5 dark:divide-white/10 dark:bg-zinc-900 dark:ring-white/10">
                            <div class="divide-y divide-zinc-200 dark:divide-white/10">
                                <div class="flex items-center justify-between gap-x-4 px-4 py-3 sm:px-6">
                                    <form class="w-full" @submit.prevent="editProject">
                                        <div class="col-span-6 sm:col-span-4 w-1/2">
                                            <InputLabel for="title" value="Название проекта" />
                                            <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" />
                                            <InputError :message="form.errors.title" class="mt-2" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-4 pt-2">
                                            <InputLabel for="description" value="Описание проекта" />
                                            <textarea id="description" v-model="form.description" type="text" class="block w-full shadow-sm border-none focus:border py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:border-amber-600 dark:focus:border-amber-500 focus:ring-amber-600 dark:focus:ring-amber-500 disabled:text-gray-500 dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 sm:text-sm sm:leading-6 bg-white/0 dark:bg-white/5 ring-1 dark:ring-white/20 rounded-md mt-1 block" />
                                            <InputError :message="form.errors.description" class="mt-2" />
                                        </div>

                                        <div class="gap-3 flex flex-wrap items-center mt-3">
                                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Сохранить
                                            </PrimaryButton>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </AppLayout>
</template>
