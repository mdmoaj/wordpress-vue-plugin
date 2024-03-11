<template>
  <div>
    <!-- <div>Howdy from Vue!</div> -->
   <LeadsUser></LeadsUser>
   <!-- <Leads></Leads> -->
  </div>
</template>

<script>
import index from '../css/index.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import LeadsUser from './components/LeadsUser.vue';
import BootstrapVue from 'bootstrap-vue';

// import Leads from './leads.vue';

// import Leads from './leads.vue';

 // Import the Leads component

export default {
    components: { LeadsUser }
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>