<template>
  <section>
    <h2 class="fs-700 ff-hub clr-neutral-400">Letzte Transaktionen:</h2>
    <div class="list p-2">
      <div
        v-for="transaction in shouldModify ? formattedTransactions.slice(0, 12).reverse() : formattedTransactions"
        :key="transaction.id"
        class="transaction"
        :class="transaction.amount > 0 ? 'transaction-positiv' : 'transaction-negativ'"
      >
        <div class="mt-6 ml-2">
          <label class="p-1 ff-hub fs-500">
            Name: {{ transaction.name }} || Betrag: {{ transaction.amount }} || Datum: {{ transaction.formattedDate }}
          </label>
        </div>
      </div>
    </div>
  </section>
</template>


<script>
export default {
  props: {
    transactions: Array,
    shouldModify: {
      type: Boolean,
      default: true
    }
  },
  data() {
    return {
      sortedTransactions: []
    };
  },
  computed: {
    formattedTransactions() {
      return this.sortedTransactions.map(transaction => ({
        ...transaction,
        formattedDate: this.formatDate(transaction.created_at)
      }));
    }
  },
  methods: {
    formatDate(dateString) {
      const date = new Date(dateString);
      const day = date.getDate().toString().padStart(2, '0');
      const month = (date.getMonth() + 1).toString().padStart(2, '0');
      const year = date.getFullYear();
      return `${day}.${month}.${year}`;
    },
    sortTransactions(sortType) {
      switch (sortType) {
        case 'unsorted':
          return this.transactions.slice();
        case 'newest':
          return this.transactions.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        case 'oldest':
          return this.transactions.slice().sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
        default:
          return this.transactions;
      }
    },
    handleSort(sortType) {
      const sortedTransactions = this.sortTransactions(sortType);
      this.sortedTransactions = sortedTransactions;
    },
    applyCustomRange() {
      const startDate = this.$parent.startDate;
      const endDate = this.$parent.endDate;
      this.sortedTransactions = this.transactions.filter(transaction =>
        this.isWithinCustomRange(transaction.created_at, startDate, endDate)
      );
    },
    isWithinCustomRange(date, startDate, endDate) {
      const transactionDate = new Date(date);
      const start = new Date(startDate);
      const end = new Date(endDate);
      return transactionDate >= start && transactionDate <= end;
    }
  },
  mounted() {
    this.sortedTransactions = this.sortTransactions('unsorted');
  }
};
</script>
