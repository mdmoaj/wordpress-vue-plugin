<template>
  <div>
  <div id="chatbot-container">
    <div id="chatbot-header">
      <div id="profile-picture">
        <div class="header_div">
          <img :src="profilePictureUrl" alt="Profile Picture">
          <h5>{{ userNameBot || 'Your Name' }}</h5>
        </div>
        <div id="refresh-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"></path>
          </svg>
        </div>
      </div>
      <div id="close-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
          <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"></path>
        </svg>
      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" id="chatbot-icon" viewBox="0 0 16 16"></svg>
    <div id="chatbot-messages" class="#chatbot_messages">
      <div class="chatbot-response-container">
        <div class="chatbot-response">Welcome to the chatbot! How can I assist you today?</div>
      </div>
      <form id="chatbot-form" style="display: none;">
        <input type="text" id="name" name="name" placeholder="Name" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="tel" id="phone" name="phone" placeholder="Phone" required>
        <button type="submit" id="submit-btn">Submit<span class="loader"></span></button>
      </form>
    </div>
    <div id="chatbot-search-input">
      <input type="text" id="chatbot-input" placeholder="Type your message">
      <div id="send-icon" class="send_button">
        <div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
          <svg id="sendIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z"></path>
          </svg>
        </div>
        <input type="hidden" id="chatbot_user">
        <span id="chatbot-search-icon"></span>
      </div>
    </div>
  </div>
  <div id="chatbot-icons" class="toggle-bot">
    <div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; z-index: 2147483646;">
      <svg id="chatIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3" stroke="black" width="24" height="24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"></path>
      </svg>
    </div>
  </div>
  
  <div>
    <button @click="fetchData">Fetch Data</button>
    <div v-if="data">
      {{ data }}
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      profilePictureUrl: '', // Set this value dynamically in your Vue component
      userNameBot: '', // Set this value dynamically in your Vue component
      data: null,
    };
  },
  methods: {
    fetchData() {
    axios.get('../wp-admin/admin-ajax.php?action=get_user_name_bot') // Replace 'your-api-endpoint' with the actual URL
      .then(response => {
        this.userNameBot = response.data.name; // Assuming your API returns { name: 'the-saved-name' }
        this.data = response.data; 
      })
      .catch(error => {
        console.error(error);
      });
  },

  },
};
</script>
<style scoped>



* {
  padding: 0px;
  margin: 0px;
  box-sizing: border-box;
}

#chatbot-messages.chatbot_messages::-moz-scrollbar,
#chatbot-messages.chatbot_messages::-webkit-scrollbar {
  width: 0px !important;
}

/* 
#chatbot-messages {
  scrollbar-width: thin !important;
  scrollbar-color: #65676a00 #7e7e7e00 !important;
} */

#chatbot-container {
  position: fixed;
  bottom: 95px;
  right: 15px;
  z-index: 9999;
  background-color: #ffffff;
  border: 1px solid #ccc;
  border-radius: 15px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  width: 400px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 10px;
  width: 420px;
  height: 785px;
  /* top: 60px; */
  display: none;
}

#chatbot-header {
  position: relative;
  width: 100%;
  border-bottom: 1px solid #ccc;
  /* padding: 0px 12px 12px 0px; */
  /* margin-top: -23px; */
}
#profile-picture {
  border-radius: 50%;
  margin-right: 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 10px 0px;
  margin-top: -15px;
}
.header_div {
  border-radius: 50%;
  margin-right: 10px;
  display: flex;
  align-items: center;
}

#profile-picture img {
  width: 100%;
  max-width: 35px;
  border-radius: 129px;
  margin-left: 9px;
}
#profile-picture h5 {
  margin: 0px 0px 0px 10px;
  font-family: inherit;
  font-weight: 600;
}

#chatbot-icon {
  position: absolute;
  bottom: 0;
  right: 0;
  display: inline-block;
  width: 40px;
  height: 40px;
  /* background-image: url(https://cdn-icons-png.flaticon.com/512/10817/10817260.png); */
  background-size: contain;
  background-repeat: no-repeat;
  cursor: pointer;
  margin-left: auto;
}

#chatbot-messages {
  height: 616px;
  overflow-y: auto;
  margin-bottom: 19px;
  padding: 10px;
}
#chatbot-messages.active {
  height: 425px;
}
.user-input-container {
  display: flex;
  justify-content: flex-end;
  align-items: flex-start;
  margin-top: 10px;
}

.user-input {
  background-color: rgb(111, 68, 252); /* New color for user input */
  color: white;
  border-radius: 5px;
  padding: 10px;
  max-width: 70%;
  word-wrap: break-word;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

.chatbot-response-container {
  display: flex;
  justify-content: flex-start;
  margin-bottom: 10px;
}

.chatbot-response {
  background-color: rgb(241, 241, 240);
  padding: 10px;
  border-radius: 4px;
  color: black;
}

#chatbot-messages .user-input {
  text-align: right;
}

#chatbot-messages .chatbot-response {
  text-align: left;
}

#chatbot-input-container {
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}

#chatbot-input {
  width: 100%;
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: none;
  z-index: 9999;
}
#chatbot-icons.toggle-bot {
  position: fixed;
  bottom: 30px;
  right: 15px;
  cursor: pointer;
  transition: 0.5s;
}
#chatbot-icons.toggle-bot:hover {
  transform: scale(1.1);
  transition: 0.5s;
}
#chatbot-form {
  width: 54%;

  position: absolute;
  bottom: 111px;
  left: 150px;
}

#chatbot-form input[type="text"],
#chatbot-form input[type="email"],
#chatbot-form input[type="tel"] {
  width: 100%;
  padding: 7px;
  margin-bottom: 4px;
  border: 1px solid #ccc;
  border-radius: 9px;
  outline: none;
  display: block !important;
  margin-left: -52px;
  margin-top: 10px;
  margin-top: 2px;
}

#chatbot-form button[type="submit"] {
  padding: 10px 20px;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#chatbot-form button[type="submit"]:hover {
  background-color: #45a049;
}
#chatbot-input-container {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}

#chatbot-search-input {
  width: 100%;
  padding: 15px;
  /* border: 1px solid #ccc; */
  border-radius: -21px;
  outline: none;
  /* margin-top: 91px; */
  margin-bottom: 2px;
  z-index: 9999;
  position: absolute;
  bottom: 0%;
  left: 50%;
  transform: translate(-50%, 0%);
}

/* Add styles for the Chatbot Users section */
#chatbot-users-container {
  padding: 20px;
}

#chatbot-users-container h1 {
  font-size: 24px;
  margin-bottom: 20px;
}

#chatbot-users-table {
  width: 100%;
  border-collapse: collapse;
}

#chatbot-users-table th,
#chatbot-users-table td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

#chatbot-users-table th {
  background-color: #f2f2f2;
}

#chatbot-users-table td:nth-child(1) {
  width: 30%;
}

#chatbot-users-table td:nth-child(2),
#chatbot-users-table td:nth-child(3) {
  width: 35%;
}

/* Add styles for numbering */
#chatbot-users-table .user-number {
  font-weight: bold;
  color: #555;
}

/* Add styles for the "No users found" message */
#chatbot-users-container p.no-users-found {
  font-style: italic;
  color: #888;
}

/* Add styles for the "Add New User" button */
#chatbot-users-container .add-new-user-button {
  margin-top: 20px;
  background-color: #4caf50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#chatbot-users-container .add-new-user-button:hover {
  background-color: #45a049;
}

/* Loader styles */
/* Add styles for the "Submit" button with loader */
#submit-btn {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

#submit-btn .loader {
  border: 4px solid rgba(0, 0, 0, 0.3);
  border-top: 4px solid #3498db;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  animation: spin 2s linear infinite;
  margin-left: 8px;
  display: none;
}

/* Show the loader when the button is in a loading state */
#submit-btn.loading .loader {
  display: block;
}

/* Hide the loader text when the loader is shown */
#submit-btn.loading span {
  visibility: hidden;
}

/* Modern styling for the settings page */
.wrap {
  max-width: 800px;
  margin: 30px auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 6px;
  background-color: #fff;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

h1.wp-heading-inline {
  font-size: 30px;
  margin-bottom: 20px;
}

h2 {
  font-size: 24px;
  margin-top: 30px;
}

#profile-picture-container {
  margin-bottom: 20px;
}

#profile-picture-container img {
  max-width: 200px;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

input[type="file"] {
  display: none;
}

input[type="submit"] {
  margin-top: 10px;
}

.button-primary {
  background-color: #0073aa;
  border-color: #0073aa;
  box-shadow: none;
}

.button-primary:hover {
  background-color: #005680;
  border-color: #005680;
}

/* Additional styles for the media upload button */
#profile-picture-upload {
  display: none;
}

#profile-picture-container:after {
  content: "Upload Picture";
  display: block;
  padding: 10px;
  text-align: center;
  background-color: #0073aa;
  color: #fff;
  cursor: pointer;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

#profile-picture-container:hover:after {
  background-color: #005680;
}
/* Add this CSS in your chatbot-style.css or any other suitable CSS file */

#profile-picture-section {
  position: relative;
  display: inline-block;
}

#profile-picture-container {
  position: relative;
}

#user-name-overlay {
  position: absolute;
  top: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.7);
  color: #fff;
  padding: 5px;
  font-size: 14px;
  border-radius: 3px;
}

#user-name-container {
  margin-top: 10px;
}

/* #close-icon {
  cursor: pointer;
  margin-left: 131px;
} */

#close-icon {
  cursor: pointer;
  position: absolute;
  right: 0;
  top: 22px;
}
/* refresh icon */

#refresh-icon {
  cursor: pointer;
  height: -1.8rem;
  width: 5.5%;
  margin-right: 40px;
  /* margin-top: -22px;
  margin-left: 330px; */
}

.chatbot-response-container {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start; /* Add this line to align the response to the left */
  margin-top: 10px;
}

.chatbot-response {
  background-color: #f0f0f0;
  color: #000000;
  border-radius: 5px;
  padding: 10px;
  max-width: 90%;
  word-wrap: break-word;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

/* Typing animation */
.chatbot-response.typing-complete::after {
  content: "_"; /* Add blinking cursor after typing animation */
  display: inline-block;
  animation: blink 1s infinite;
}

@keyframes blink {
  50% {
    opacity: 0;
  }
}

/* Loading animation */
.chatbot-response.loading::before {
  content: "";
  display: inline-block;
  margin-right: 10px;
  width: 30px;
  height: 10px;
  background-color: #ed49fe;
  border-radius: 5px;
  animation: loading 1s infinite;
}

@keyframes loading {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
  100% {
    opacity: 1;
  }
}

#chatbot-input {
  padding-right: 40px; /* Leave space for the send button */
}

#chatbot-send-button {
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
  background-color: transparent;
  border: none;
  cursor: pointer;
}

/* CSS for the typing animation */
@keyframes typing {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}

/* CSS for the blinking animation */
@keyframes blinking {
  0% {
    opacity: 0.2;
  }
  20% {
    opacity: 1;
  }
  100% {
    opacity: 0.2;
  }
}

/* Style for the typing dots */
.typing-dots {
  display: inline-block;
  overflow: hidden;
  position: relative;
  width: 0;
}

.typing-dots span {
  display: inline-block;
  animation: blinking 1s infinite;
}

/* Style for the blinking dots */
.blinking-dots {
  display: inline-block;
  overflow: hidden;
  position: relative;
}

.blinking-dots span {
  display: inline-block;
  animation: blinking 1s infinite;
}

#chatbot-icons {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 50px;
  height: 50px;
  background-color: rgb(65, 179, 234);
  border-radius: 50%;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  z-index: 99999;
}

#chatIcon {
  width: 24px;
  height: 24px;
}

#arrowUpIconContainer {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 50px;
  height: 50px;
  background-color: rgb(65, 179, 234);
  border-radius: 50%;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}

#arrowUpIcon {
  width: 24px;
  height: 24px;
}
.refresh_box {
  display: flex;
  align-items: center;
}

.send_button {
  cursor: pointer;
  width: 1.25rem;
  height: 1.25rem;
  /* display: flex; */
  margin-bottom: 28px;
  margin-top: -35px;
  margin-left: 360px;
}

.sendBtn {
  width: 20px;
  border: 0px;
  background-color: transparent;
}

@media (max-width: 768px) {
  #chatbot-container {
    bottom: 5%; /* Adjust position */
    right: 5%; /* Adjust position */
    width: 85%; /* Make the container even more responsive */
    height: 80%;
    z-index: 9999999999999999999;
  }

  #chatbot-search-input {
    margin-top: -100px;
    width: 99%;
    margin-right: 45px;
  }
  .send_button {
    cursor: pointer;
    width: 1.25rem;
    height: 1.25rem;
    /* display: flex; */
    margin-bottom: 28px;
    /* margin-top: -35px;  */
    /* margin-left: 380px; */
  }

  #chatbot-form {
    /* display: flex; */
    /* width: 30%; */

    /* margin-top: -187px; */
    /* z-index: 9999; */
    /* margin-left: -72px; */
    /* z-index: 9999; */
    /* margin-top: 15px; */
  }
}
@media (max-width: 844px) {
  #chatbot-container {
    width: 350px;
    height: 660px;
    bottom: 100px;
    right: 13px;
  }
  .send_button {
    margin-left: 285px;
  }
}

@media (max-width: 425px) {
  #chatbot-container {
    width: 310px;
    height: 555px;
    bottom: 90px;
    right: 13px;
  }
  .send_button {
    margin-left: 250px;
  }
}










</style>