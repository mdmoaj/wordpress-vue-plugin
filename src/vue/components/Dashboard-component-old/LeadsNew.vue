<template>
<div>

    <div class="container pt-5">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <h1 class="heading_text mb-0">Chatbot Dashboard</h1>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-end">
                <div class="Chatbot_serarch_box d-flex align-items-center justify-content-center shadow-sm">
                    <button class="me-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="search" placeholder="search" v-model="searchQuery" @input="updateData" />
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="d-sm-flex align-content-center justify-content-between mb-3">
                    <span class="d-flex align-items-center">
                        <label for="" class="me-2">select :</label>
                        <input type="checkbox" name="" id="">
                    </span>
                    <div class="sort_by">

                        <span class="d-sm-flex align-content-center">
                            <span class="d-flex align-items-center">
                                <label for="">Sort by :</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Date</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </span>

                            <span class="d-flex align-items-center">
                                <label for="">View :</label>
                                <select class="form-select" v-model="selectedView" @change="updateData" aria-label="Default select example">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                </select>
                            </span>

                        </span>

                    </div>
                </div>
                <div class="leads_page_box shadow-lg">
                    <div class="table-responsive" v-if="!loadingData">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email Id</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in allData" :key="user.id" class="data-row">
                                    <td>{{ formatTimestamp(user.timestamp) }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.phone }}</td>
                                    <td>{{ user.country }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else>
                        <loader />
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-3">
                <div>
                    <div class="pagination">
                        <ul class="list-unstyled d-flex align-items-center">
                            <li>
                                <button @click="loadPage(currentPage - 1)" :disabled="currentPage === 1">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                            </li>
                            <li v-for="page in displayedPages" :key="page">
                                <button @click="setCurrentPage(page)" :class="{ active: currentPage === page }">{{ page }}</button>
                            </li>
                            <li>
                                <button @click="loadPage(currentPage + 1)" :disabled="currentPage === totalPages">
                                    <font-awesome-icon :icon="['fas', 'angle-right']" />
                                </button>

                            </li>
                        </ul>
                    </div>

                </div>
                <button class="export">Export</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import Loader from './loader.vue';

export default {
    name: 'Leads',
    data() {
        return {
            searchQuery: '',
            selectedView: '10', // Default to 10 items per page
            allData: [], // Your complete data
            userData: [], // Initialize as an empty array
            loadingData: false,
            currentPage: 1, // Current page number
            // totalPages: 10, // Total number of pages (initially set to 10)
            loading: false, // Loading indicator
            totalPages: 1,
            // loadingData: false,
        };
    },
    components: {
        Loader
    },
    mounted() {
        this.fetchUsers(this.currentPage);

        // Add this line to check data availability
        // console.log(this.allData);
    },
    computed: {
        filteredData() {
            return this.allData;
        },
        // Generate an array of page numbers based on total data rows and selected view
        dynamicPageNumbers() {
            return Array.from({
                length: this.totalPages
            }, (_, index) => index + 1);
        },

        // Update the filteredData based on the current page
        filteredData() {
            const selectedView = parseInt(this.selectedView);
            const startIndex = (this.currentPage - 1) * selectedView;
            const endIndex = startIndex + selectedView;
            return this.allData.slice(startIndex, endIndex);
        },
        displayedPages() {
            const pageCount = 3; // Number of pages to display (including current page)
            const pages = [];

            for (let i = Math.max(1, this.currentPage - Math.floor(pageCount / 2)); i <= Math.min(this.totalPages, this.currentPage + Math.floor(pageCount / 2)); i++) {
                pages.push(i);
            }

            return pages;
        },

    },

    watch: {
        searchQuery: function (newSearchQuery, oldSearchQuery) {
            // console.log('Search query changed:', newSearchQuery);
            this.updateData(); // Make sure this line is included
        },
        selectedView: 'updateData',
    },
    methods: {
        updateData() {
            const selectedView = parseInt(this.selectedView);
            const startIndex = (this.currentPage - 1) * selectedView;
            this.userData = this.allData.slice(startIndex, startIndex + selectedView);
            // console.log('Updated userData:', this.userData);
            let filteredData = this.allData.slice(startIndex, startIndex + selectedView);

            // Filter data based on the search query for "Name" field
            if (this.searchQuery.trim() !== '') {
                const searchTerm = this.searchQuery.toLowerCase();
                filteredData = filteredData.filter(user => {
                    return user.name.toLowerCase().includes(searchTerm);
                });
            }

            this.userData = filteredData;
        },

        fetchUsers(page) {
            this.loadingData = true;
            // console.log('fetchUsers method called with page:', page);

            const selectedView = parseInt(this.selectedView);

            axios
                .get(`../wp-admin/admin-ajax.php?action=fetch_chatbot_users&page=${page}&view=${selectedView}`)
                .then(response => {
                    // console.log('Received data:', response.data);

                    this.allData = response.data.user_data;
                    this.currentPage = response.data.current_page;
                    this.totalPages = Math.ceil(response.data.total_rows / selectedView);
                    // console.log('Total Pages', this.totalPages);

                    // Update the userData array with the fetched data
                    this.updateData();

                    // console.log('userData:', this.allData);

                    this.loadingData = false;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    this.loadingData = false;
                });
        },

        setCurrentPage(page) {
            this.currentPage = page;
            // Add logic here to load data for the selected page
            this.fetchUsers(page); // Update to fetch data for the selected page
        },
        loadPage(page) {
            if (page === this.currentPage) return; // Do not reload the same page
            if (page < 1) {
                page = 1; // Ensure the page is not less than 1
            } else if (page > this.totalPages) {
                page = this.totalPages; // Ensure the page is not greater than the total number of pages
            }
            this.setCurrentPage(page);
        },
        loadDataForPage(page) {
            // Make an Axios request to fetch data for the specified page
            this.fetchUsers(page); // You can reuse your existing fetchUsers method
        },
        formatTimestamp(timestamp) {
            const date = new Date(timestamp);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear().toString().slice(-2);
            return `${day}.${month}.${year}`;
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
