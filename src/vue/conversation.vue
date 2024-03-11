<template>
 <div>

  <!-- <UserConversations/> -->
  <Leads/>


 </div>
  
</template>

<script>
// import UserConversations from './components/UserConversations.vue';
import Leads from './components/Dashboard-component/Leads.vue';



export default {
    name: "Conversations",
    data() {
        return {};
    },
    methods: {},
    components: { Leads }
};
</script>

<style scoped>

</style>
