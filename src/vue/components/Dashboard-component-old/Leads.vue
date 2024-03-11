<template>
<div class="col-12 ">
    <div class="position-relative">
        <div class="leads_box  shadow-lg" id="leadsBox">
            <div class="leads_heading d-flex align-items-center justify-content-between">

                <h3 class="mb-0">Leads</h3>

                <button class="se_all" id="seeAll">See all</button>
                <p class="mb-0">{{ totalUserCount }}</p>
            </div>

            <div class="table_responsive mt-4" id="tableResponsive">
                <table class="leads_table" id="leadTable">
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

                        <!-- <tr v-for="user in userData" :key="user.id" class="data-row"></tr> -->
                        <tr v-for="user in userData" :key="user.id" class="data-row">
                            <td>
                                <div v-if="user">
                                    <ul class="list-unstyled d-flex align-items-center mb-0">
                                        <li class="d-flex align-items-center py-3">
                                            <div class="short_name short_name2">
                                                <p class="mb-0">{{ getInitials(user.name) }}</p>
                                            </div>
                                            <p class="ms-4 mb-0">{{ user.name }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <p>{{ user.email }}</p>
                            </td>

                            <td>
                                <p>{{ user.phone }}</p>
                            </td>

                            <td>
                                <p>{{ user.city }}</p>
                            </td>

                            <td>
                                <p> {{ user.country }} </p>
                            </td>

                            <td>
                                <div class="view_button_box">
                                    <button class="" @click="toggleLeads()" id="viewChat">View Chat</button>
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <div class="leads_box_hidden_content ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="new_users_child d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="mb-0"> Willie Jennings</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="send_and_response">
                            <div class="send_message_box">
                                <div class="d-flex align-items-center">
                                    <div class="image_box me-4">
                                        <!-- <img src="./image/ai_image.png"
                                            class="img-fluid rounded-top" alt=""> -->
                                    </div>
                                    <div class="send_content">
                                        <h5 class="mb-2">Chatbot</h5>
                                        <div class="mb-2">
                                            <p>Hi, how can I help you?</p>
                                        </div>
                                        <p>8:29pm, 09-11-2023</p>
                                    </div>
                                </div>
                            </div>
                            <div class="respone_message d-flex align-items-center justify-content-end">
                                <div class="d-flex align-items-center">
                                    <div class="respone_content">
                                        <div class="mb-2">
                                            <p>Give me the contact number of Klizos</p>
                                        </div>
                                        <p class="text-end">8:29pm, 09-11-2023</p>
                                    </div>
                                </div>
                            </div>
                            <div class="send_message_box">
                                <div class="d-flex align-items-center">
                                    <div class="image_box me-4">
                                        <!-- <img src="./image/ai_image.png"
                                            class="img-fluid rounded-top" alt=""> -->
                                    </div>
                                    <div class="send_content">
                                        <h5 class="mb-2">Chatbot</h5>
                                        <div class="mb-2">
                                            <p>Here you go, +91 1234567890</p>
                                        </div>
                                        <p>8:30pm, 09-11-2023</p>
                                    </div>
                                </div>
                            </div>
                            <div class="respone_message d-flex align-items-center justify-content-end">
                                <div class="d-flex align-items-center">
                                    <div class="respone_content">
                                        <div class="mb-2">
                                            <p>And how does Klizos calculate the estimate for a
                                                project?</p>
                                        </div>
                                        <p class="text-end">8:31pm, 09-11-2023</p>
                                    </div>
                                </div>
                            </div>
                            <div class="send_message_box">
                                <div class="d-flex align-items-center">
                                    <div class="image_box me-4">
                                        <!-- <img src="./image/ai_image.png"
                                            class="img-fluid rounded-top" alt=""> -->
                                    </div>
                                    <div class="send_content">
                                        <h5 class="mb-2">Chatbot</h5>
                                        <div class="mb-2">
                                            <p>Here you go, +91 1234567890</p>
                                        </div>
                                        <p>8:30pm, 09-11-2023</p>
                                    </div>
                                </div>
                            </div>

                            <div class="respone_message d-flex align-items-center justify-content-end">
                                <div class="d-flex align-items-center">
                                    <div class="respone_content">
                                        <div class="mb-2">
                                            <p>And how does Klizos calculate the estimate for a
                                                project?</p>
                                        </div>
                                        <p class="text-end">8:31pm, 09-11-2023</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="leads_box_hidden shadow-lg">

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
        toggleLeads() {
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
