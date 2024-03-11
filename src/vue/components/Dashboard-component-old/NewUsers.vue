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
                <div class="main-body">

                    <!-- Breadcrumb -->
                    <!-- <nav aria-label="breadcrumb" class="main-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
              </ol>
            </nav> -->
                    <!-- /Breadcrumb -->

                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                            class="rounded-circle" width="150">
                                        <div class="mt-3">
                                            <h4 class="my-4">{{ user ? user.name : "" }}</h4>
                                            <button class="btn btn-outline-primary">Message</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ user ? user.name : "" }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ user ? user.email : "" }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ user ? user.phone : "" }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ user ? user.country : "" }}, {{ user ? user.regionName : "" }}, {{ user ?
                                                user.city : "" }}, {{ user ? user.zip : "" }}
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="row gutters-sm">
                                <div class="col-sm- mb-3">
                                    <div class="h-100 shadow-sm">
                                        <div class="card-body ">
                                            <div class="container content">
                                                <div class="row">

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
        };
    },
    components: {

    },
    // created() {
    //     this.fetchTotalUserCount(); // Fetch the initial user count

    // },

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
                    this.conversations = response.data.data;
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

    },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

.app {
    background-color: azure;
    width: 100%;
    height: 100%;
    padding-bottom: 50px;
}

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: azure;
}

.app {
    padding-bottom: 50px;
}

.heading_text {
    color: #2C384A;
    font-size: 28px;
    font-weight: 500;

}

.Chatbot_serarch_box {
    width: 100%;
    max-width: 300px;
    min-height: 48px;
    background-color: rgb(255, 255, 255);
    border-radius: 8px;
}

.Chatbot_serarch_box input {
    height: 100%;
    min-height: 48px;
    width: 100%;
    background-color: rgb(255, 255, 255);
    border: 0px;
    outline: none;
    padding: 5px 10px 5px 0px;
    font-size: 15px;
    color: #A9AEB5;
    border-radius: 8px;
}

.Chatbot_serarch_box button {
    border: 0px;
    background-color: transparent;
    margin-left: 10px;
    color: #A9AEB5;
    display: flex;
    align-items: center;
    margin-top: 5px;
}

.new_users,
.leads_box {
    width: 100%;
    min-height: 356px;
    border-radius: 10px;
    background-color: #fff;
    padding: 30px;
    padding-bottom: 0px;
}

.short_name_scroll {
    overflow-y: auto;
    height: 274px;
}

.short_name_scroll::-webkit-scrollbar {
    width: 5px;
}

.new_users_child div h3 {
    color: #2C384A;
    font-size: 20px;
    font-weight: 500;
}

.new_users_child div select {
    border: 0px;
    outline: none;
    background-color: transparent;
    padding-left: 0px;
    padding-top: 0px;
    color: #A9AEB5;
    font-size: 14px;
    font-weight: 400;

}

.new_users_child div select.form-select:focus {
    border-color: #86b6fe00;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 109, 253, 0);
}

.new_users_child>p {
    color: #007BD9;
    text-align: right;
    font-size: 24px;
    font-weight: 500;
}

.short_name {
    width: 50px;
    height: 50px;
    border-radius: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.short_name1 {
    background-color: #EFCFCF;
}

.short_name2 {
    background-color: #A6BDF8;
}

.short_name3 {
    background-color: #BCE885;
}

.short_name4 {
    background-color: #FFE6A5;
}

.short_name p {
    color: #FFF !important;
    text-align: center;
    font-size: 17px;
    font-weight: 500;
    letter-spacing: 0.17px;
}

.short_name+p {
    color: #2C384A;
    font-size: 16px;
    font-weight: 400;
    letter-spacing: 0.16px;
}

.short_name_vew {
    border: 0px;
    background-color: #007BD9;
    color: #FFF;
    font-size: 14px;
    letter-spacing: 0.14px;
    padding: 3px 12px;
    border-radius: 5px;
}

/* ------------------- */
.new_users_child a span {
    color: #2C384A;
    font-size: 12px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    letter-spacing: 0.12px;
    border-radius: 5px;
    border: 2px solid #F84444;
    display: inline-flex;
    padding: 6px 18px;
    justify-content: center;
    align-items: center;
}

#bars {
    width: 100% !important;
    height: 273px !important;
}

.leads_heading h3 {
    color: #2C384A;
    font-size: 20px;
    font-weight: 500;
}

.leads_heading p {
    border: 0px;
    outline: none;
    background-color: transparent;
    padding-left: 0px;
    padding-top: 0px;
    color: #A9AEB5;
    font-size: 14px;
    font-weight: 400;
}

.leads_table {
    width: 100%;
}

.leads_table th p {
    color: #A9AEB5;
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    letter-spacing: 0.14px;
}

.leads_table td p {
    color: #2C384A;
    font-size: 16px;
    font-weight: 400;
    letter-spacing: 0.16px;
}

.leads_table.active td:nth-child(2),
.leads_table.active td:nth-child(3),
.leads_table.active td:nth-child(4),
.leads_table.active td:nth-child(5),
.leads_table.active th:nth-child(2),
.leads_table.active th:nth-child(3),
.leads_table.active th:nth-child(4),
.leads_table.active th:nth-child(5) {
    display: none;
}

.view_button_box {
    display: flex;
    align-items: center;
    justify-content: end;
}

.view_button_box button {
    padding: 8px 18px;
    color: #FFF;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.14px;
    border-radius: 5px;
    background: linear-gradient(180deg, #007BD9 0%, #2194EB 100%);
    border: 0px;
}

.view_button_box i {
    color: #A9AEB5;
    margin-left: 10px;
}

.leads_box {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;

}

.leads_box.active {
    width: 450px;
    overflow-x: hidden;
    transition: 0.5s;
}

.table_responsive {
    width: 100%;
    min-width: 1250px;
    overflow: auto;
    max-height: 350px;
}

.leads_box_hidden {
    width: 100%;
    min-height: 427px;
    border-radius: 10px;
    background-color: #fff;
    padding: 30px;
    padding-bottom: 0px;
}

.se_all {
    border: 0px;
    color: #A9AEB5;
    text-align: right;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    background-color: transparent;
    display: none;
}

.se_all.active {
    display: block;
}

.se_all.active+p {
    display: none;
}

.table_responsive.active {
    min-width: 100%;
}

/* ============================================================================leads table page================================================================= */

.leads_page_box {
    width: 100%;
    border-radius: 10px;
    background-color: #fff;
    padding: 30px;
}

.export {
    display: inline-flex;
    padding: 10px 28px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    border-radius: 4px;
    background: linear-gradient(90deg, #007BD9 0%, rgba(0, 145, 255, 0.70) 100%), #007BD9;
    color: #FFF;
    border: 0px;
    font-size: 16px;
    font-weight: 500;
}

.leads_page_box .table_rasponsive .table th {
    color: #232323;
    text-align: center;
    font-size: 18px;
    font-weight: 400;
    letter-spacing: 0.18px;
    border-bottom-color: #007BD9 !important;
}

.leads_page_box .table_rasponsive .table td {
    color: #000;
    text-align: center;
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.sort_by span span label {
    color: #2C384A;
    font-size: 14px;
    font-weight: 500;
}

.sort_by span span select {
    color: #2C384A;
    font-size: 14px;
    font-weight: 500;
    width: 100px;
    background-color: transparent;
    border: 0px;
}

.sort_by span span select.form-select {
    background-position: 50% !important;
    padding: 5px !important;
}

.form-select:focus {
    border-color: #86b6fe00;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(122, 124, 128, 0);
}

.pagination ul li {
    margin: 0px 5px;
}

.pagination ul li p {
    width: 30px;
    height: 30px;
    border-radius: 5px;
    background-color: #fff;
    border: 0px;
    color: #333;
    text-align: center;
    font-size: 13px;
    font-weight: 500;
    display: flex;
    align-items: end;
    justify-content: center;
}

.pagination ul li button:hover {
    background-color: #007BD9;
    color: #fff;
    transition: 0.3s;
}

.pagination ul li button {
    width: 30px;
    height: 30px;
    border-radius: 5px;
    background-color: #fff;
    border: 0px;
    color: #333;
    text-align: center;
    font-size: 13px;
    font-weight: 500;
    transition: 0.3s;
}
</style>
