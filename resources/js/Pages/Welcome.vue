<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navi from '../Components/Navi.vue';
defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();
</script>

<template>
    <Head title="Welcome" />
    <Navi></Navi>
    <div class="content text-center mt-40">
        <div class="speachbubble ff-hub fs-500 p-4 m-auto">
            <p>Ganz schön leer hier...</p>
            <p>Du solltest dich Anmelden dann siehst du mehr :D</p>
        </div>
        <img src="../../img/ghost.png" alt="" class="m-auto">
      </div>

</template>

