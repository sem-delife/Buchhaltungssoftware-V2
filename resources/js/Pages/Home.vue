<template>
     <!-- <Head title="Welcome" /> -->
    <div>
      <Navi></Navi>
      <div class="grid mt-20 ml-8">
        <transaction-list :transactions="transactions" ></transaction-list>
        <user-infomation :transactions="transactions" :user="user"></user-infomation>
      </div>
   
    </div>
  </template>
  
  <script>
  import { Head } from '@inertiajs/vue3';
  import Navi from '../Components/Navi.vue';
  import transactionList from '@/Components/transaction-list.vue';
  import UserInfomation from '@/Components/user-infomation.vue';

  export default {
    components: {
      Navi,
      transactionList,
        UserInfomation
    },
    props: {
      user: Object,
      transactions: Array
    },
  }
  </script>
  