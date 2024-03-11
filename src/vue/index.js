import Vue from 'vue';
import App from './App.vue';
import BootstrapVue from 'bootstrap-vue'; // Add this import
import 'bootstrap-vue/dist/bootstrap-vue.css';
import leads from './leads.vue';
import conversation from './conversation.vue';
import Settings from './Settings.vue';
import LeadsUser from './components/LeadsUser.vue';
import UserProfileModal from './components/UserProfileModal.vue';
import Chatbot from './Chatbot.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// Add the solid icons to the library
library.add(fas)

// Register the FontAwesomeIcon component globally
Vue.component('font-awesome-icon', FontAwesomeIcon)

// Create and export the event bus
const eventBus = Vue.prototype.$eventBus;




// import chats from '';
Vue.use(BootstrapVue);

// Mount the main App component
new Vue({
  el: '#vwp-plugin',
  render: h => h(App),
});

// Mount the leads component
new Vue({
  el: '#vwp-leads',
  render: h => h(leads),
});

new Vue({
  el: '#vwp-conversation',
  render: h => h(conversation),
});

new Vue({
  el: '#vwp-settings',
  render: h => h(Settings),
});

new Vue({
  el: '#vwp-leads-user', // Choose a unique id for your LeadsUser component
  render: h => h(LeadsUser),
});

new Vue({
  el: '#vwp-user-profile-modal', // Choose a unique id for your LeadsUser component
  render: h => h(UserProfileModal),
});

// Conditional Chatbot Mounting
if (document.getElementById('vue-chatbot')) { // Check if the element exists
  new Vue({
      el: '#vue-chatbot',
      render: h => h(Chatbot),
  });
}


