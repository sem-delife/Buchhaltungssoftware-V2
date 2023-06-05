<template>
  <div>
    <Navi></Navi>
    <TransactionBtns class="mb-20" @sort="handleSort" @toggleCustomRange="toggleCustomRange" @openTransactionForm="openTransactionForm"></TransactionBtns>
    <transaction-list ref="transactionList" :transactions="transactions" :shouldModify="false"></transaction-list>

    <transaction-create :user="user" v-if="showTransactionForm" @closeTransactionForm="closeTransactionForm"></transaction-create>

    <div class="custom-range" :class="{ invisible: customRangeHidden }">
      <label class="clr-neutral-400" for="start-date">Startdatum:</label>
      <input type="date" id="start-date" v-model="startDate">
      <label class="clr-neutral-400" for="end-date">Enddatum:</label>
      <input type="date" id="end-date" v-model="endDate">
      <button class="btn-input" @click="applyCustomRange">Anwenden</button>
    </div>
  </div>
</template>

<script>
import TransactionBtns from '@/Components/transaction-btns.vue';
import Navi from '../Components/Navi.vue';
import TransactionList from '@/Components/transaction-list.vue';
import UserInfomation from '@/Components/user-infomation.vue';
import TransactionCreate from '@/Components/transaction-create.vue';

export default {
  components: {
    Navi,
    transactionList: TransactionList,
    UserInfomation,
    TransactionBtns,
    TransactionCreate
  },
  props: {
    user: Object,
    transactions: Array
  },
  data() {
    return {
      customRangeHidden: true,
      startDate: '',
      endDate: '',
      showTransactionForm: false
    };
  },
  methods: {
    handleSort(sortType) {
      this.$refs.transactionList.handleSort(sortType);
    },
    toggleCustomRange() {
      this.customRangeHidden = !this.customRangeHidden;
    },
    openTransactionForm() {
      this.showTransactionForm = true;
    },
    closeTransactionForm() {
      this.showTransactionForm = false;
    },
    applyCustomRange() {
      this.$refs.transactionList.applyCustomRange(this.startDate, this.endDate);
      this.startDate = null;
      this.endDate = null;
      this.customRangeHidden = true;
    }
  }
};
</script>
