<template>
  <section class="create_transaction p-6" v-show="showTransactionForm">
    <h3 class="fs-500 clr-neutral-400 mb-2">Transaktions Daten:</h3>
    <form action="/create">
      <input type="hidden" name="user_id" :value="user.id">
      <input class="mr-4" type="text" name="name" placeholder="Name">
      <input class="mr-4" type="text" name="amount" placeholder="0.50">
      <input class="mr-4" type="date" name="date">
      <input class="btn-input  mt-4" type="submit" value="Erstellen">
      <button class=" btn-input" id="create-close" @click="closeForm">Abbrechen</button>
    </form>
  </section>
</template>

<script>
export default {
  props: {
    user: Object
  },
  data() {
    return {
      showTransactionForm: true
    };
  },
  methods: {
    closeForm() {
      this.$emit('closeTransactionForm');
    }
  }
};
</script>
