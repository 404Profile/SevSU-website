<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="'/'">
        <img :src="$page.props.logo" class="h-16 w-auto">
    </Link>
</template>
