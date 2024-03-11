<template>
<div class="col-12 ">
    <div class="position-relative">

        <div class="leads_box_hidden shadow-lg position-relative px-2 py-4">
            <div class="side_lide">
                <div class="leads_box side_show_active  shadow-lg" :class="{ 'active': hiddenDiv, 'new_active': newActive }" id="leadsBox">
                    <div class="leads_heading d-flex align-items-center justify-content-between">

                        <h3 class="mb-0">Leads</h3>

                        <button class="se_all" id="seeAll">See all</button>
                        <p class="mb-0">{{ totalUserCount }}</p>
                    </div>

                    <div class="table_responsive mt-4" :class="{ 'active': hiddenDiv }" id="tableResponsive" @scroll="handleScroll">
                        <table class="leads_table leads_table_active" :class="{ 'active': hiddenDiv, 'scroll_active': scrollY >= 10 }" id="leadTable">
                            <thead>
                                <tr>
                                    <th style="width: 264px;">
                                        <p class="mb-0">Name</p>
                                    </th>
                                    <th style="width: 290px;">
                                        <p class="mb-0">Email Id</p>
                                    </th>
                                    <th style="width: 250px;">
                                        <p class="mb-0">Phone Number</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">City</p>
                                    </th>
                                    <th>
                                        <p class="mb-0">Country</p>
                                    </th>
                                    <th style="width: 130px;">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(conversation, index) in conversations" :key="index" class="data-row">
                                    <td>
                                        <div v-if="conversation">
                                            <ul class="list-unstyled d-flex align-items-center mb-0">
                                                <li class="d-flex align-items-center py-3">
                                                    <div class="short_name leads_short" :class="{
                                                            'short_name1': startsWith(conversation.user_name, ['A', 'B', 'C', 'D', 'E', 'G']),
                                                            'short_name2': startsWith(conversation.user_name, ['H', 'I', 'J', 'K', 'L', 'M']),
                                                            'short_name3': startsWith(conversation.user_name, ['N', 'O', 'P', 'Q', 'R', 'S', 'Z']),
                                                            'short_name4': startsWith(conversation.user_name, ['T', 'U', 'V', 'W', 'X', 'Y']),
                                                        }">
                                                        <p class="mb-0">{{ getInitials(conversation.user_name) }}</p>
                                                    </div>
                                                    <p class="ms-4 mb-0">{{conversation.user_name }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{{ conversation.user_email }}</p>
                                    </td>

                                    <td>
                                        <p>{{ conversation.user_phone }}</p>
                                    </td>

                                    <td>
                                        <p>{{ conversation.city }}</p>
                                    </td>

                                    <td>
                                        <p> {{ conversation.country }} </p>
                                    </td>

                                    <td>
                                        <div class="view_button_box position-relative me-2">
                                            <button :class="{ 'active': conversation.session_id  == buttonId }" @click="toggleLeads(conversation)" id="viewChat">
                                                <span v-if="(conversation.session_id  == buttonId) && (hiddenDiv || newActive)">Close</span>
                                                <span v-else>View
                                                    Chat</span>
                                            </button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="arrow_svg ms-1" :class="{ 'active': (conversation.session_id  == buttonId) && (hiddenDiv || newActive) }" height="1em" viewBox="0 0 320 512">
                                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                            </svg>
                                            <button @click="toggleLeadssideber()" v-if="conversation.session_id  == buttonId" class="hidden_button_danger" value="View Chat"></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="leads_box_hidden_content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="new_users_child d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-0">{{ conversation ? conversation.user_name : "" }}</h3>
                                    <!-- <h3 class="mb-0">{{ user ? user.name : "" }}</h3> -->
                                    <p class="d-md-none mb-0">{{ conversation ? conversation.user_email : "" }}</p>
                                    <p class="d-md-none mb-0">{{ conversation ? conversation.user_phone : "" }}</p>
                                    <p class="d-md-none mb-0">{{ conversation ? conversation.city : "" }}<span>{{ conversation ? conversation.country :
                                            "" }}</span></p>
                                </div>

                                <button class=" fa_bars_close fa_bars_table" v-for="(conversation, index) in conversations" :key="index" @click="faBarsCloseMenu(1)">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                                    </svg>
                                </button>

                                <button class=" fa_bars_show fa_bars_table" @click="faBarsCloseMenu(2)">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                        <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                    </svg>
                                </button>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="send_and_response">
                                <div v-for="(conver, index) in filteredConversations" :key="index">
                                    <div class="send_message_box">
                                        <div class="d-flex align-items-center">
                                            <div class="image_box me-4">
                                                <!-- <img src="./image/ai_image.png" class="img-fluid rounded-top" alt=""> -->
                                            </div>
                                            <div class="send_content">
                                                <h5 class="mb-2">{{ conver ? conver.user_name : "" }}</h5>
                                                <div class="mb-2">

                                                    <p>{{ conver.user_message ? conver.user_message : "" }} </p>
                                                </div>
                                                <p>{{ conver.timestamp }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="respone_message d-flex align-items-center justify-content-end">
                                        <div class="d-flex align-items-center">
                                            <div class="respone_content">
                                                <div class="mb-2">
                                                    <p>{{ conver.bot_response }}</p>
                                                </div>
                                                <p class="text-end">{{ conver.timestamp }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
</template>

<script>
import axios from "axios";
// import UserProfileModal from './UserProfileModal.vue';

export default {
    data() {
        return {
            scrollY: 0,
            buttonId: null,
            viewportWidth: 0,
            newActive: true,
            hiddenDiv: false,
            heddenChat: false,
            userData: [],

            showUserProfileModal: false,
            selectedUser: null,
            isModalVisible: false,
            //   isModalVisible: false, // Initially, the modal is hidden
            user: null,
            currentPage: 1,
            perPage: 6,
            // totalUserCount: 0,
            totalUserCount: 0,
            conversation: null,

            conversations: [],
            // conversation: null,
            selectedUserId: null,
            // filteredConversations: [],

            conversationsms: [],
            filteredConversations: [],
            loading: false,
        };
    },
    components: {

    },
    // created() {
    //     this.fetchTotalUserCount(); // Fetch the initial user count

    // },
    created() {
        // Fetch conversations when the component is created
        this.fetchConversations();
        this.fetchConversationsforsms();
    },

    mounted() {
        // Fetch users when the component is mounted
        this.fetchUsers(1); // You can pass the desired page number
        this.fetchUsers(this.currentPage);
        this.fetchTotalUserCount(); // Fetch the total user count
        this.fetchConversations();
        setTimeout(() => {
            this.heddenChat = true;
        }, 1000);
        this.updateWidths();
        window.addEventListener('resize', this.updateWidths);
        // this.cuntryApi();
    },

    methods: {

        handleScroll(event) {
            this.scrollY = event.target.scrollTop;
        },

        faBarsCloseMenu(number, conversation) {
            if (number === 1) {
                this.newActive = true;
            } else if (number === 2) {
                this.hiddenDiv = false;
            }

            // this.conversation = conversation;
            // this.selectedUserId = conversation.session_id ;
            // this.filteredConversations = this.conversationsms.filter((convo) => convo.session_id  === this.selectedUserId);
            // console.log('Filtered Conversastions' . this.filteredConversations);

        },

    toggleLeads(conversation) {
    this.conversation = conversation;
    this.selectedUserId = conversation.session_id ;
    this.filteredConversations = this.conversationsms.filter((convo) => convo.session_id  === this.selectedUserId);
    console.log(this.filteredConversations);

    if (this.filteredConversations.length > 0) { // Check if there are any filtered conversations
        this.hiddenDiv = true;
        this.buttonId = this.filteredConversations[0].session_id ; // Access the session_id  of the first item
    }

    this.newActive = false;
    // Check if the elements are defined before accessing their classList
    if (this.$refs.leadsBox) {
        this.$refs.leadsBox.classList.toggle('active');
    }
    if (this.$refs.leadTable) {
        this.$refs.leadTable.classList.toggle('active');
    }
    if (this.$refs.tableResponsive) {
        this.$refs.tableResponsive.classList.toggle('active');
    }
    if (this.$refs.seeAll) {
        this.$refs.seeAll.classList.toggle('active');
    }
},


        toggleLeadssideber() {
            this.viewportWidth = window.innerWidth;
            if (this.viewportWidth >= 768) {
                this.hiddenDiv = !this.hiddenDiv;
            };
            if (this.viewportWidth <= 768) {
                this.newActive = false;
            }
        },

        showModal(conversation) {
            this.conversation = conversation; // Set the user data
            this.isModalVisible = true; // Show the modal

        },
        fetchUsers(page) {
            this.loading = true;
            axios
                .get(
                    `../wp-admin/admin-ajax.php?action=fetch_chatbot_users&page=${page}&per_page=${this.perPage}`
                )
                .then((response) => {
                    if (response.data.user_data) {
                        this.userData = response.data.user_data.map((user) => {
                            // Remove avatarSvg
                            this.loading = false;
                            return user;
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                    this.loading = false;
                });
        },
        fetchConversations() {
            this.loading = true;
            axios
                .get("../wp-admin/admin-ajax.php?action=fetch_conversations")
                .then((response) => {
                    const rawData = response.data.data;
                    // console.log("Raw Data:", rawData); // Log raw data for debugging
                    const uniqueConversations = [];

                    // Create a map to track unique users based on session_id 
                    const seenUserIds = new Set();
                    for (const conversation of rawData) {
                        if (!seenUserIds.has(conversation.session_id )) {
                            seenUserIds.add(conversation.session_id );
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
                    // console.log('smsssssssssssssssssssssssssssssss', this.conversationsms);
                    if (this.conversationsms.length > 0) {
                        // Update this part to set the firstConversationUserId
                        const firstConversationUserId = this.conversationsms[0].session_id ;
                        if (typeof firstConversationUserId !== "undefined") {
                            // console.log("new Losanka", firstConversationUserId);
                        } else {
                            // console.log("session_id  is undefined for the first conversation");
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

        formatTimestamp(timestamp) {
            // You can use JavaScript's Date methods to format the timestamp as needed
            const date = new Date(timestamp * 1000); // Assuming your timestamp is in seconds
            const formattedDate = date.toLocaleDateString(); // You can customize the format as needed
            return formattedDate;
        },
        getInitials(name) {
            const names = name.split(" ");
            if (names.length >= 2) {
                // Apply the abbreviation for all names
                const firstNameInitial = names[0][0];
                const lastNameInitial = names[names.length - 1][0];
                return firstNameInitial + lastNameInitial;
            } else if (names.length === 1) {
                return names[0][0];
            } else {
                return "";
            }
        },
        startsWith(word, letters) {
            return letters.some(letter => word.startsWith(letter));
        },

        updateWidths() {
            this.viewportWidth = window.innerWidth;
            if (this.viewportWidth <= 768) {
                this.hiddenDiv = false;
            };
        },

        // cuntryApi(){
        //     axios
        //         .get(
        //             `https://rest-countries10.p.rapidapi.com/country/%7Bname%7D`
        //         )
        //         .then((response) => {
        //            console.log(response);
        //         })
        //         .catch((error) => {
        //             console.error("Error fetching data:", error);
        //         });

        // }

    },
};
</script>

<style scoped></style>
