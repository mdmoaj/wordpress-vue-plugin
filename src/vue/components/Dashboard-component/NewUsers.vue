<template>
    <div class="new_users shadow-lg">
        <div class="new_users_child d-flex align-items-center justify-content-between">
            <div>
                <h3 class="mb-0">New Users</h3>
                <select class="form-select" aria-label="Default select example">
                    <option selected>August - September 2023</option>
                    <option value="1">Open this selec6546</option>
                    <option value="2">Open this select</option>
                    <option value="3">Open this selec</option>
                </select>
            </div>
            <p>{{ totalUserCount }}</p>
        </div>

        <div class="short_name_scroll">
            <ul class="list-unstyled">
                <li class="d-flex align-items-center justify-content-between mt-4" v-for="(user, index) in userData"
                    :key="index">
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="short_name" :class="{
                            'short_name1': startsWith(user.name, ['A', 'B', 'C', 'D', 'E', 'G']),
                            'short_name2': startsWith(user.name, ['H', 'I', 'J', 'K', 'L', 'M']),
                            'short_name3': startsWith(user.name, ['N', 'O', 'P', 'Q', 'R', 'S', 'Z']),
                            'short_name4': startsWith(user.name, ['T', 'U', 'V', 'W', 'X', 'Y']),
                        }">
                            <p class="mb-0">{{ getInitials(user.name) }}</p>
                        </div>
                        <p class="mb-0 ms-4"> {{ user.name }}</p>
                    </div>
                    <div>
                        <button class="short_name_vew" @click="showModal(user)">View</button>
                    </div>
                </li>
            </ul>
        </div>




        <b-modal id="modal-center" size="lg" v-model="isModalVisible" centered
            :title="user ? ' ' + user.name : 'User Profile'">
            <div class="container">

                <div class="row g-4 pt-3 pb-4">
                    <div class="col-lg-5">
                        <div class="modal_profile_box shadow-lg d-flex align-items-center justify-content-center px-4 py-5">
                            <div class="d-flex flex-column align-items-center justify-content-center">

                                <div class="short_name" :class="shortNameClass(newData)">
                                    <p class="mb-0">{{ newData }}</p>
                                </div>
                                <h3 class="mb-0 mt-3 text-center">{{ user ? user.name : "" }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="modal_profile_box d-flex align-items-center shadow-lg h-100 w-100 px-4 py-5">
                            <ul class="list-unstyled mb-0">
                                <li class="d-sm-flex align-items-center mb-3">
                                    <p class="mb-0">Full Name :</p>
                                    <p class="mb-0">{{ user ? user.name : "" }}</p>
                                </li>
                                <li class="d-sm-flex align-items-center mb-3">
                                    <p class="mb-0">Email :</p>
                                    <p class="mb-0"> {{ user ? user.email : "" }}</p>
                                </li>
                                <li class="d-sm-flex align-items-center mb-3">
                                    <p class="mb-0">Phone :</p>
                                    <p class="mb-0">{{ user ? user.phone : "" }}</p>
                                </li>
                                <li class="d-sm-flex align-items-center mb-3">
                                    <p class="mb-0">Address :</p>
                                    <p class="mb-0"> {{ user ? user.country : "" }}, {{ user ? user.regionName : "" }}, {{
                                        user ?
                                        user.city : "" }}, {{ user ? user.zip : "" }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </b-modal>






    </div>
</template>

<script>
import axios from "axios";
// import UserProfileModal from './UserProfileModal.vue';

export default {
    data() {
        return {
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

            conversations: [],
            loading: false,
            newData: null
        };
    },
    mounted() {
        // Fetch all users when the component is mounted
        this.fetchUsers();
        this.fetchTotalUserCount();
        this.fetchConversations();
    },
    methods: {
        showModal(user) {
            this.user = user;
            this.isModalVisible = true;
            const names = this.user.name.split(" ");
            if (names.length >= 2) {
                this.word = names[0][0];
                const firstNameInitial = names[0][0];
                const lastNameInitial = names[names.length - 1][0];
                this.newData = firstNameInitial + lastNameInitial;
            }
        },
        fetchUsers() {
            this.loading = true;
            axios
                .get(
                    `../wp-admin/admin-ajax.php?action=fetch_chatbot_users`
                )
                .then((response) => {
                    if (response.data.user_data) {
                        this.userData = response.data.user_data.map((user) => {
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
                    this.conversations = response.data.data;
                    this.loading = false;
                })
                .catch((error) => {
                    console.error("Error fetching conversations:", error);
                    this.loading = false;
                });
        },
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

        // getInitials start 
        getInitials(name) {
            const names = name.split(" ");
            if (names.length >= 2) {
                this.word = names[0][0];
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

        // getInitials end 

        shortNameClass(name) {
            const firstLetter = name && name.length > 0 ? name.charAt(0).toUpperCase() : '';
            if (['A', 'B', 'C', 'D', 'E', 'G'].includes(firstLetter)) {
                return 'short_name1';
            } else if (['H', 'I', 'J', 'K', 'L', 'M'].includes(firstLetter)) {
                return 'short_name2';
            } else if (['N', 'O', 'P', 'Q', 'R', 'S', 'Z'].includes(firstLetter)) {
                return 'short_name3';
            } else if (['T', 'U', 'V', 'W', 'X', 'Y'].includes(firstLetter)) {
                return 'short_name4';
            } else {
                return '';
            }
        },


    },
};
</script>

<style scoped>
.modal-footer {
    display: none !;
}
</style>
