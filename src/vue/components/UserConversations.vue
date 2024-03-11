<template>
<div>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet"> -->
    <div class="container">
        <h3 class="text-center">Messaging</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <input type="text" class="search-bar" placeholder="Search" />
                                <span class="input-group-addon">
                                    <button type="button">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <tr v-if="loading">
                            <td colspan="4" class="loader-cell">
                              <div class="loader"></div>
                            </td>
                          </tr>
                        <div v-for="(conversation, index) in conversations" :key="index" @click="showModal(conversation)" class="chat_list active_chat">
                            <div class="chat_people">
                                <div class="chat_img">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="sunil" />
                                </div>
                                <div class="chat_ib">
                                    <h5 @click="showModal(conversation)">
                                        {{ conversation.user_name }}
                                        <span class="chat_date">{{ conversation.timestamp }}</span>
                                    </h5>
                                    <p>{{ conversation.user_message }}</p>
                                    <!-- <p>{{ conversation.user_id }}</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <b-modal id="modal-center" size="lg" v-model="isModalVisible" centered :title="conversation ? ' ' + conversation.user_name : 'User Profile'">
      <div id="app">
        <div class="mesgs">
          <div class="msg_history">
            
            <div v-for="(conversation, index) in filteredConversations" :key="index">
              <div class="message" :class="{
                incoming_msg: index % 2 === 0,
                outgoing_msg: index % 2 !== 0,
              }">
                <div class="incoming_msg_img">
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="sunil" />
                </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p class="text-start">{{ conversation.user_message ? conversation.user_message : "" }} </p>
                    <span class="time_date">{{ conversation.timestamp }}</span>
                  </div>

                  <div class="sent_msg">
                  <p class="text-end">{{ conversation.bot_response }} </p>
                  <span class="time_date">{{ conversation.timestamp }}</span>
                </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </b-modal>
    
</div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            conversations: [],
            loading: false,
            isModalVisible: false,
            conversation: null,
            selectedUserId: null,
            filteredConversations: [],
            loading: false, 
        };
    },
    created() {
        // Fetch conversations when the component is created
        this.fetchConversations();
        this.fetchConversationsforsms();
    },
    methods: {
        showModal(conversation) {
          this.conversation = conversation;
            this.selectedUserId = conversation.user_id;
            this.isModalVisible = true;
            // Filter the conversations based on selectedUserId
            this.filteredConversations = this.conversationsms.filter((convo) => convo.user_id === this.selectedUserId);
        },

        fetchConversations() {
            this.loading = true;
            axios
                .get("../wp-admin/admin-ajax.php?action=fetch_conversations")
                .then((response) => {
                    const rawData = response.data.data;
                    // console.log("Raw Data:", rawData); // Log raw data for debugging
                    const uniqueConversations = [];

                    // Create a map to track unique users based on user_id
                    const seenUserIds = new Set();
                    for (const conversation of rawData) {
                        if (!seenUserIds.has(conversation.user_id)) {
                            seenUserIds.add(conversation.user_id);
                            uniqueConversations.push(conversation);
                        }
                    }

                    this.conversations = uniqueConversations;
                    // console.log('thas asdjkasdk', this.conversations);

                    if (this.conversations.length > 0) {
                        // console.log("Conversations:", this.conversations);
                    } else {
                        // console.log("No conversations found");
                    }
                    this.loading = false;
                })
                .catch((error) => {
                    // console.error("Error fetching conversations:", error);
                    this.loading = false;
                });
        },
        fetchConversationsforsms() {
            this.loading = true;
            axios
                .get("../wp-admin/admin-ajax.php?action=fetch_conversations")
                .then((response) => {
                    this.conversationsms = response.data.data;
                    if (this.conversationsms.length > 0) {
                        // Update this part to set the firstConversationUserId
                        const firstConversationUserId = this.conversationsms[0].user_id;
                        if (typeof firstConversationUserId !== "undefined") {
                            // console.log("new Losanka", firstConversationUserId);
                        } else {
                            // console.log("user_id is undefined for the first conversation");
                        }
                    } else {
                        // console.log("No conversations found");
                    }
                    this.loading = false;
                })
                .catch((error) => {
                    console.error("Error fetching conversations:", error);
                    this.loading = false;
                });
        },

    },

    //   computed: {
    //     filteredItems() {

    //       return this.items.filter(item => item.category === filterCategory);
    //     },
    //   },

    // mounted(){
    //     console.log(this.conversations);
    //     const filterCategory = this.conversations.user_name;
    //    console.log('weewrwerwerwerwererw rw ' +  filterCategory);
    // }
};
</script>

<style scoped>
.container {
    max-width: 1170px;
    margin: auto;
}

img {
    max-width: 100%;
}

.inbox_people {
    background: #f8f8f8 none repeat scroll 0 0;
    float: left;
    overflow: hidden;
    width: 40%;
    border-right: 1px solid #c4c4c4;
}

.inbox_msg {
    border: 1px solid #c4c4c4;
    clear: both;
    overflow: hidden;
}

.top_spac {
    margin: 20px 0 0;
}

.recent_heading {
    float: left;
    width: 40%;
}

.headind_srch {
    padding: 10px 29px 10px 20px;
    overflow: hidden;
    border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
    color: #05728f;
    font-size: 21px;
    margin: auto;
}

.srch_bar input {
    border: 1px solid #cdcdcd;
    border-width: 0 0 1px 0;
    width: 80%;
    padding: 2px 0 4px 6px;
    background: none;
}

.srch_bar .input-group-addon button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    padding: 0;
    color: #707070;
    font-size: 18px;
}

.srch_bar .input-group-addon {
    margin: 0 0 0 -27px;
}

.chat_ib h5 {
    font-size: 15px;
    color: #464646;
    margin: 0 0 8px 0;
}

.chat_ib h5 span {
    font-size: 13px;
    float: right;
}

.chat_ib p {
    font-size: 14px;
    color: #989898;
    margin: auto;
}

.chat_img {
    float: left;
    width: 11%;
}

.chat_ib {
    float: left;
    padding: 0 0 0 15px;
    width: 88%;
}

.chat_people {
    overflow: hidden;
    clear: both;
}

.chat_list {
    border-bottom: 1px solid #c4c4c4;
    margin: 0;
    padding: 18px 16px 10px;
}

.inbox_chat {
    height: 550px;
    overflow-y: scroll;
}

.active_chat {
    background: #ebebeb;
}

.incoming_msg_img {
    display: inline-block;
    width: 6%;
}

.received_msg {
    display: inline-block;
    padding: 0 0 0 10px;
    vertical-align: top;
    width: 92%;
}

.received_withd_msg p {
    background: #ebebeb none repeat scroll 0 0;
    border-radius: 3px;
    color: #646464;
    font-size: 14px;
    margin: 0;
    padding: 10px 10px 10px 12px;
    width: 100%;
}

.time_date {
    color: #747474;
    display: block;
    font-size: 12px;
    margin: 8px 0 0;
}

.received_withd_msg {
    width: 57%;
}

.mesgs {
    float: left;
    padding: 30px 15px 0 25px;
    width: 100%;
}

.sent_msg p {
    background: #05728f none repeat scroll 0 0;
    border-radius: 3px;
    font-size: 14px;
    margin: 0;
    color: #fff;
    padding: 10px 10px 10px 12px;
    width: 100%;
}

.outgoing_msg {
    overflow: hidden;
    margin: 26px 0 26px;
}

.sent_msg {
    float: right;
    width: 46%;
}

.input_msg_write input {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    color: #4c4c4c;
    font-size: 15px;
    min-height: 48px;
    width: 100%;
}

.type_msg {
    border-top: 1px solid #c4c4c4;
    position: relative;
}

.msg_send_btn {
    background: #05728f none repeat scroll 0 0;
    border: medium none;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 17px;
    height: 33px;
    position: absolute;
    right: 0;
    top: 11px;
    width: 33px;
}

.messaging {
    padding: 0 0 50px 0;
}

.msg_history {
    height: 516px;
    overflow-y: auto;
}

.chat_list.active_chat {
    cursor: pointer;
    /* Set cursor style to pointer */
}

.chat_ib h5[data-v-4e06daae] {
    cursor: pointer;
}

.text-start {
  text-align: center;
}
.text-end {
  text-align: center;
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
</style>
