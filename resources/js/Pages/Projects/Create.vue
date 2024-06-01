<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import {useForm, router, Link} from "@inertiajs/vue3";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {onMounted, onUnmounted, ref, watch} from "vue";

const props = defineProps({
    allTags: Object,
    filters: Object,
});

const form = useForm({
    title: '',
    description: '',
    project_photo_path: null,
    presentation_path: null,
    group: '',
});

const groups = [];
const numberOfIterations = 8;

for (let i = 1; i <= numberOfIterations; i++) {
    const title = `ИТ/б-22-${i}-о`;
    groups.push({ title });
}

const createProject = () => {
    if (photoInput.value) {
        form.project_photo_path = photoInput.value.files[0];
    }

    if (pdfInput.value) {
        form.presentation_path = pdfInput.value.files[0];
    }

    form.post(route('projects.store'), {
        preserveScroll: true,
    });
}

const photoPreview = ref(null);
const photoInput = ref(null);

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    photoPreview.value = null;
    clearPhotoFileInput();
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

const uploadingPdf = ref(false);
const pdfInput = ref(null);
const message = ref('');

const selectNewPdf = () => {
    pdfInput.value.click();
};

const updatePdfPreview = () => {
    const pdf = pdfInput.value.files[0];

    if (!pdf) return;

    uploadingPdf.value = true;

    const reader = new FileReader();

    reader.onerror = (error) => {
        console.log(error);
        uploadingPdf.value = false;
        message.value = 'Ошибка загрузки файла';
    }

    reader.onload = () => {
        uploadingPdf.value = false;
        message.value = 'Файл успешно загружен';
    };

    reader.readAsDataURL(pdf);
};

const deletePdf = () => {
    clearPdfFileInput();
    message.value = 'Файл успешно удален';
};

const clearPdfFileInput = () => {
    if (pdfInput.value?.value) {
        pdfInput.value.value = null;
        message.value = '';
    }
};
</script>

<template>
    <AppLayout title="Создать новый проект">
        <section class="flex flex-col gap-y-8 py-8">

            <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                        Создание нового проекта от команды
                    </h1>
                </div>
            </header>

            <div>
                <div class="grid flex-1 auto-cols-fr gap-y-8">
                    <div class="flex flex-col gap-y-6">
                        <div class="divide-y divide-zinc-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-zinc-950/5 dark:divide-white/10 dark:bg-zinc-900 dark:ring-white/10">
                            <div class="divide-y divide-zinc-200 dark:divide-white/10">
                                <div class="block items-center justify-between gap-x-4 px-4 py-3 sm:px-6">

                                    <div>
                                        <p class="mt-1 text-base text-gray-600 dark:text-gray-400">
                                            Проект будет создан от лица команды - "{{ $page.props.auth.user.current_team.name }}"
                                        </p>
                                    </div>

                                    <div class="pt-4">
                                        <form @submit.prevent="createProject">
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

                                            <div class="col-span-6 sm:col-span-4 pt-2 pb-3">
                                                <InputLabel for="group" value="Выберите группу" />
                                                <select v-model="form.group" :class="{'border-red-500' : form.errors.roles}" class="block shadow-sm border-none focus:border py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:border-amber-600 dark:focus:border-amber-500 focus:ring-amber-600 dark:focus:ring-amber-500 disabled:text-gray-500 dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 sm:text-sm sm:leading-6 bg-white/0 dark:bg-white/5 ring-1 dark:ring-white/20 rounded-md" tabindex="1">
                                                    <option selected value="" class="dark:bg-zinc-800">Выберите группу</option>
                                                    <option v-for="(group, index) in groups" :key="index" :value="group.title" class="dark:bg-zinc-800">
                                                        {{ group.title }}
                                                    </option>
                                                </select>
                                                <InputError :message="form.errors.group" class="mt-2" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-4 pb-3">
                                                <input ref="photoInput" type="file" accept="image/*" class="hidden" @change="updatePhotoPreview">
                                                <InputLabel for="image" value="Изображение" />

                                                <div class="block">
                                                    <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                                                        Выбрать изображение
                                                    </SecondaryButton>

                                                    <SecondaryButton type="button" class="mt-2 mr-2" @click.prevent="deletePhoto">
                                                        Удалить изображение
                                                    </SecondaryButton>
                                                </div>

                                                <div v-show="photoPreview">
                                                    <div id="preview">
                                                        <img class="h-[500px] w-auto" :src="photoPreview" alt="Ошибка отображения диплома" />
                                                    </div>
                                                </div>

                                                <InputError :message="form.errors.project_photo_path" class="mt-2" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-4 pb-3">
                                                <input ref="pdfInput" type="file" accept="application/pdf" class="hidden" @change="updatePdfPreview">
                                                <InputLabel for="pdf" value="Презентация" />

                                                <div class="block">
                                                    <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPdf">
                                                        Выбрать презентацию
                                                    </SecondaryButton>

                                                    <SecondaryButton type="button" class="mt-2 mr-2" @click.prevent="deletePdf">
                                                        Удалить презентацию
                                                    </SecondaryButton>
                                                </div>

                                                <p class="text-gray-600 dark:text-gray-400">{{ message }}</p>

                                                <InputError :message="form.errors.presentation_path" class="mt-2" />
                                            </div>

                                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Создать
                                            </PrimaryButton>

                                        </form>
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
