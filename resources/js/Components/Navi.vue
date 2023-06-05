<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';


</script>

<template>
    <nav class="nav p-4">
      <ul>
        <li>
          <a href="/home">
            <h1 class="fs-800 ff-zen clr-accent-400">Buchhaltung</h1>
          </a>
        </li>
  
        <li>

          <a
                    v-if="$page.props.auth.user"
                    href="/transaction"
                    class="fs-600 clr-accent-400 ff-mono"
                    >Transaktions</a
                >
          <Link
                    v-else
                    :href="route('login')"
                    class="fs-600 clr-accent-400 ff-mono"
                    >Log in</Link
                >
        </li>
  
        <li>
          <Link  v-if="$page.props.auth.user" :href="route('logout')" method="post" as="button" class="fs-600 clr-accent-400 ff-mono">
                                            Log Out
          </Link>
          <Link     
                    v-else
                    :href="route('register')"
                    class="fs-600 clr-accent-400 ff-mono"
                    >Register</Link
                >
        </li>
      </ul>
      <div class="background"></div>
    </nav>
  </template>
  
