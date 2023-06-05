<template>
    <section>
      <h3 class="fs-700 clr-neutral-400 ff-hub">Benutzer Info</h3>
      <div class="userInfo p-3 ff-hub flow">
        <p class="fs-500 clr-neutral-400">Name: {{ user.name }}</p>
        <p class="fs-500 clr-neutral-400">Email: {{ user.email }}</p>
        <p class="fs-500 clr-neutral-400">Kontostand: {{ user.amount }} Euro</p>
        <p class="fs-500 clr-neutral-400">Anzahl der Transaktionen: {{ transactionCount }}</p>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    props: {
      user: Object,
      transactions: Array
    },
    computed: {
      transactionCount() {
        return this.transactions.length;
      }
    }
  };
  </script>
  