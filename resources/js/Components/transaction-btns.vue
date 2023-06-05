<template>
  <section>
    <div class="sub-nav p-3 m-auto ff-hub fs-500">
      <div class="dropdown" :class="{ open: isDropdownOpen }">
        <button class="btn btn_neutral dropdown-toggle" id="filterDropdown" @click="toggleDropdown">
          Filter
        </button>
        <div class="dropdown-menu" v-show="isDropdownOpen" aria-labelledby="filterDropdown">
          <button class="dropdown-item p-1" @click="sortTransactions('unsorted'); closeDropdown()">- No Filter</button>
          <button class="dropdown-item p-1" @click="sortTransactions('newest'); closeDropdown()">- Neuste</button>
          <button class="dropdown-item p-1" @click="sortTransactions('oldest'); closeDropdown()">- Älteste</button>
        </div>
      </div>
      <button class="btn btn_neutral" @click="toggleCustomRange">Bestimmter Zeitraum</button>
      <button class="btn btn_positiv" id="create-open" @click="openTransactionForm">Transaktion erstellen</button>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      isDropdownOpen: false
    };
  },
  mounted() {
    document.addEventListener("click", this.closeDropdown);
  },
  beforeDestroy() {
    document.removeEventListener("click", this.closeDropdown);
  },
  methods: {
    sortTransactions(sortType) {
      this.$emit('sort', sortType);
    },
    toggleCustomRange() {
      this.$emit('toggleCustomRange');
      this.closeDropdown();
    },
    openTransactionForm() {
      this.$emit('openTransactionForm');
      this.closeDropdown();
    },
    toggleDropdown() {
      this.isDropdownOpen = !this.isDropdownOpen;
    },
    closeDropdown(event) {
      if (!event || !event.target.closest(".dropdown")) {
        this.isDropdownOpen = false;
      }
    }
  }
};
</script>
