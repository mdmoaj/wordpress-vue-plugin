<template>
 
  <div>

    <Dashboard/>

  </div>
  

  
</template>

<script>
import axios from "axios";
// import UserProfileModal from './UserProfileModal.vue';
// import { createAvatar } from "@dicebear/avatars";
// import * as style from "@dicebear/avatars-avataaars-sprites";
// import VuejsPaginate from "vuejs-paginate";
// import UserStats from "./UserStats.vue";
import Dashboard from "./Dashboard-component/Dashboard.vue";


export default {
  data() {
    return {
      userData: [],
      userAvatar: "avatar-image-url.jpg",
      showUserProfileModal: false,
      selectedUser: null,
      isModalVisible: false,
      //   isModalVisible: false, // Initially, the modal is hidden
      user: null,
      currentPage: 1,
      perPage: 6,
      // totalUserCount: 0,
      totalUserCount: 0,
      pollingInterval: null, // Variable to hold the polling interval
      conversations: [],
      loading: false, 
    };
  },
  components: {
  
    Dashboard
},


  mounted() {
    // Fetch users when the component is mounted
    this.fetchUsers(1); // You can pass the desired page number
    this.fetchUsers(this.currentPage);
    this.fetchTotalUserCount(); // Fetch the total user count
    this.fetchConversations();
  },
  methods: {
    //     showModal(userId) {
    //     // You can use the userId here as needed
    //     this.showUserProfileModal = true; // Set showUserProfileModal to true to open the modal
    //     console.log();
    //   },
    showModal(user) {
      // You can use the userId here as needed
      this.user = user; // Set the user data
      // console.log(user);
      this.isModalVisible = true; // Show the modal

    },
    fetchUsers(page) {
      this.loading = true;
      axios
        .get(
          `../wp-admin/admin-ajax.php?action=fetch_chatbot_users&page=${page}&per_page=${this.perPage}`
        )
        .then((response) => {
          // console.log("Response:", response.data);
          // Ensure that the response structure matches your expectations
          if (response.data.user_data) {
            this.userData = response.data.user_data.map((user) => {
              // Generate a random avatar for each user
              const avatar = createAvatar(style, {
                seed: user.id, // You can use a unique identifier for the seed
              });
              this.loading = false;
              return {
                ...user,
                avatarSvg: avatar,
              };
            });
          }
        })
        .catch((error) => {
          // console.error("Error fetching data:", error);
          this.loading = false;
        });
    },
  fetchConversations() {
      this.loading = true;
      axios
        .get("../wp-admin/admin-ajax.php?action=fetch_conversations")
        .then((response) => {
          this.conversations = response.data.data;
          this.loading = false;
        })
        .catch((error) => {
          // console.error("Error fetching conversations:", error);
          this.loading = false;
        });
    },
    
    paginateHandler(page) {
      this.currentPage = page;
      this.fetchUsers(page);
    },
    //All users or registered users
  
      fetchTotalUserCount() {
    axios
      .get('../wp-admin/admin-ajax.php?action=get_total_user_count')
      .then((response) => {
        if (response.data.total_user_count) {
          this.totalUserCount = response.data.total_user_count;
        }
      })
      .catch((error) => {
        console.error('Error fetching total user count:', error);
      });
  },
  // startPolling() {
  //     // Poll every 5 seconds (adjust as needed)
  //     this.pollingInterval = setInterval(() => {
  //       this.fetchTotalUserCount();
  //     }, 5000);
  //   },
  //   stopPolling() {
  //     // Stop the polling interval when the component is destroyed
  //     if (this.pollingInterval) {
  //       clearInterval(this.pollingInterval);
  //     }
  //   },

  
  

    formatTimestamp(timestamp) {
      // You can use JavaScript's Date methods to format the timestamp as needed
      const date = new Date(timestamp * 1000); // Assuming your timestamp is in seconds
      const formattedDate = date.toLocaleDateString(); // You can customize the format as needed
      return formattedDate;
    },
  },
};
</script>

<style scoped>
.cards {
  width: 100%;
  max-width: 800px;
  background-color: #fff;
  margin: 0 auto;
  box-shadow: 0px 0px 5px gray;
}

p {
  margin-top: 0;
  margin-bottom: 1rem;
  color: rgb(44 56 74 / 38%);
}
.icon {
  display: inline-block;
  color: inherit;
  text-align: center;
  vertical-align: -0.125rem;
  fill: currentcolor;
}
.icon:not(.icon-c-s):not(.icon-custom-size) {
  width: 1rem;
  height: 1rem;
  font-size: 1rem;
  margin-left: -85px;
}
.avatar {
  width: 40px; /* Set the width and height to your preferred size */
  height: 40px;
  border-radius: 50%; /* Makes the avatar round */
  overflow: hidden; /* Ensures the image is contained within the circle */
  margin-right: 10px; /* Add spacing between the avatar and text */
}

.avatar img {
  width: 100%; /* Ensures the image fills the round avatar */
  height: 100%;
  object-fit: cover; /* Maintain aspect ratio and cover the circle */
}

body{
  margin-top:20px;
  color: #1a202c;
  text-align: left;
  background-color: #e2e8f0;    
}
.main-body {
  padding: 15px;
}
.card {
  box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 0 solid rgba(0,0,0,.125);
  border-radius: .25rem;
}

.card-body {
  flex: 1 1 auto;
  min-height: 1px;
  padding: 1rem;
}

.gutters-sm {
  margin-right: -8px;
  margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
  padding-right: 8px;
  padding-left: 8px;
}
.mb-3, .my-3 {
  margin-bottom: 1rem!important;
}

.bg-gray-300 {
  background-color: #e2e8f0;
}
.h-100 {
  height: 100%!important;
}
.shadow-none {
  box-shadow: none!important;
}

.my-4 {

  margin-top: -0.8000000000000007rem !important;

  margin-bottom: 4.111111000000001rem !important;

}

/* Last few chats box*/
body{
  background:#ff0000;    
}
.chat-list {
  padding: 0;
  font-size: .8rem;
}

.chat-list li {
  margin-bottom: 10px;
  overflow: auto;
  color: #ffffff;
}

.chat-list .chat-img {
  float: left;
  width: 48px;
}

.chat-list .chat-img img {
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  width: 100%;
}

.chat-list .chat-message {
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  background: #5a99ee;
  display: inline-block;
  padding: 10px 20px;
  position: relative;
}

.chat-list .chat-message:before {
  content: "";
  position: absolute;
  top: 15px;
  width: 0;
  height: 0;
}

.chat-list .chat-message h5 {
  margin: 0 0 5px 0;
  font-weight: 600;
  line-height: 100%;
  font-size: .9rem;
}

.chat-list .chat-message p {
  line-height: 18px;
  margin: 0;
  padding: 0;
}

.chat-list .chat-body {
  margin-left: 20px;
  float: left;
  width: 70%;
}

.chat-list .in .chat-message:before {
  left: -12px;
  border-bottom: 20px solid transparent;
  border-right: 20px solid #5a99ee;
}

.chat-list .out .chat-img {
  float: right;
}

.chat-list .out .chat-body {
  float: right;
  margin-right: 20px;
  text-align: right;
}

.chat-list .out .chat-message {
  background: #fc6d4c;
}

.chat-list .out .chat-message:before {
  right: -12px;
  border-bottom: 20px solid transparent;
  border-left: 20px solid #fc6d4c;
}

.card .card-header:first-child {
  -webkit-border-radius: 0.3rem 0.3rem 0 0;
  -moz-border-radius: 0.3rem 0.3rem 0 0;
  border-radius: 0.3rem 0.3rem 0 0;
}
.card .card-header {
  background: #17202b;
  border: 0;
  font-size: 1rem;
  padding: .65rem 1rem;
  position: relative;
  font-weight: 600;
  color: #ffffff;
}

.content{
  margin-top:40px;    
}

.loader-cell {
  text-align: center;
}

.loader {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #e74c3c; /* Red loader */
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.headingLeads{


font-size: 1.5rem;


}

</style>
