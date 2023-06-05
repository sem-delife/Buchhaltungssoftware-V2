<script setup lang="ts">
import Navi from '../Components/Navi.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Navi></Navi>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        

        <div
            class="w-full sm:max-w-md  px-6 py-4  bg-neutral-500 overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
