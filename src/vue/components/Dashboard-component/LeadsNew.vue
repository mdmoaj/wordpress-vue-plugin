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
                        <input v-model="checkInput" type="checkbox" name="" id="">
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
                                    <th></th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email Id</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in allData" :key="user.id" class="data-row">
                                    <td> <input v-if="checkInput === true" type="checkbox" v-model="selectedUserIds" :value="user.id"></td>

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
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" /></svg>
                                </button>
                            </li>
                            <li v-for="page in displayedPages" :key="page">
                                <button @click="setCurrentPage(page)" :class="{ active: currentPage === page }">{{ page }}</button>
                            </li>
                            <li>
                                <button @click="loadPage(currentPage + 1)" :disabled="currentPage === totalPages">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" /></svg>
                                </button>
                            </li>
                        </ul>
                    </div>

                </div>
                <button class="export" @click="toggleExportModal">Export</button>
            </div>
        </div>
    </div>
    <div v-if="showExportModal" class="export-modal">
        <button @click="exportToCSV" :class="{ 'green-button': exportType === 'CSV' }">Export as CSV</button>
        <button @click="exportToPDF" :class="{ 'red-button': exportType === 'PDF' }">Export as PDF</button>
    </div>

</div>
</template>

<script>
import axios from 'axios';
import Loader from './loader.vue';
import {
    saveAs
} from 'file-saver';
import pdfmake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import Swal from 'sweetalert2';

pdfmake.vfs = pdfFonts.pdfMake.vfs;

export default {
    name: 'Leads',
    data() {
        return {
            checkInput: false,
            searchQuery: '',
            selectedView: '10', // Default to 10 items per page
            allData: [], // Your complete data
            userData: [], // Initialize as an empty array
            loadingData: false,
            currentPage: 1, // Current page number
            // totalPages: 10, // Total number of pages (initially set to 10)
            loading: false, // Loading indicator
            totalPages: 1,
            selectedUserIds: [],
            showExportModal: false,
            user: null,
            // papa: null,

            // loadingData: false,
        };
    },
    components: {
        Loader
    },
    mounted() {
        this.fetchUsers(this.currentPage);

        // Add this line to check data availability
    },
    computed: {
        filteredData() {
            return this.userData;
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
            this.updateData(); // Make sure this line is included
        },
        selectedView: 'updateData',
    },
    methods: {

        // exportToCSV() {
        //     // Logic to export selected users as CSV
        // },
        // exportToPDF() {
        //     // Logic to export selected users as PDF
        // },
        toggleExportModal() {
            // this.selectedUserIds = this.allData;
            // console.log('Selected users IDs' . this.selectedUserIds);
            this.showExportModal = !this.showExportModal;
        },

        // Export selected users as CSV
        exportToCSV() {
            if (this.selectedUserIds.length === 0) {
                Swal.fire({
                    position: 'center', // Center the dialog
                    icon: 'warning',
                    title: 'Please select at least one user to export.',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            const selectedUsers = this.allData.filter(user =>
                this.selectedUserIds.includes(user.id)
            );

            // Create an array to hold CSV rows
            const csvRows = [];
            // Add header row
            csvRows.push(['ID', 'Name', 'Email', 'Phone', 'Country']);
            // Add data rows
            selectedUsers.forEach(user => {
                csvRows.push([user.id, user.name, user.email, user.phone, user.country]);
            });

            // Convert the array of rows to CSV format
            const csvContent = csvRows.map(row => row.join(',')).join('\n');

            // Create a Blob with the CSV data
            const blob = new Blob([csvContent], {
                type: 'text/csv;charset=utf-8;'
            });

            // Create a download link and trigger a click event to download the CSV file
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'selected_users.csv';
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            Swal.fire({
                position: 'center', // Center the dialog
                icon: 'success',
                title: 'CSV export completed successfully',
                showConfirmButton: false,
                timer: 1500
            });
        },

        exportToPDF() {
            if (this.selectedUserIds.length === 0) {
                Swal.fire({
                    position: 'center', // Center the dialog
                    icon: 'warning',
                    title: 'Please select at least one user to export.',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            const selectedUsers = this.allData.filter(user =>
                this.selectedUserIds.includes(user.id)
            );

            // Define the PDF document content with landscape orientation
            const pdfContent = {
                content: [{
                        text: 'Selected Users List',
                        style: 'header',
                    },
                    {
                        table: {
                            headerRows: 1,
                            widths: ['auto', '*', '*', '*', '*'], // Adjust the number of columns to match your data
                            body: [
                                ['ID', 'Name', 'Email', 'Phone', 'Country'],
                                ...selectedUsers.map(user => [user.id, user.name, user.email, user.phone, user.country]),
                            ],
                        },
                    },
                ],
                styles: {
                    header: {
                        fontSize: 18,
                        bold: true,
                        alignment: 'center',
                        margin: [0, 0, 0, 10],
                    },
                },
                // Set page orientation to landscape
                pageOrientation: 'landscape',
            };

            // Generate the PDF document
            const pdfDoc = pdfmake.createPdf(pdfContent);

            // Download the PDF file
            pdfDoc.download('selected_users.pdf');
            Swal.fire({
                position: 'center', // Center the dialog
                icon: 'success',
                title: 'PDF export completed successfully',
                showConfirmButton: false,
                timer: 1500
            });

        },

        updateData() {
            const selectedView = parseInt(this.selectedView);
            const startIndex = (this.currentPage - 1) * selectedView;
            this.userData = this.allData.slice(startIndex, startIndex + selectedView);
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

            const selectedView = parseInt(this.selectedView);

            axios
                .get(`../wp-admin/admin-ajax.php?action=fetch_chatbot_users_leads&page=${page}`)
                .then(response => {

                    this.allData = response.data.user_data;
                    this.currentPage = response.data.current_page;
                    this.totalPages = Math.ceil(response.data.total_rows / selectedView);

                    // Update the userData array with the fetched data
                    this.updateData();
                    console.log(this.allData);

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
.green-button {
    background-color: green;
    color: white;
}

.red-button {
    background-color: red;
    color: white;
}

.swal2-popup {
    margin-top: 300px;
    /* Adjust this value as needed */
}
</style>
