<template>
  <div>
    
   <LeadsNew/>
   
  </div>
  
</template>

<script>
import axios from 'axios';
import LeadsNew from './components/Dashboard-component/LeadsNew.vue';


export default {
    name: 'Leads',
    data() {
        return {
            userData: [],
            currentPage: 1,
            totalPages: 10,
            loading: false, // Loading indicator
        };
    },
    mounted() {
        // Fetch users for the initial page
        this.fetchUsers(this.currentPage);
    },
    methods: {
        fetchUsers(page) {
            this.loading = true; // Set loading state
            // Fetch data from the PHP endpoint using AJAX
            axios.get(`../wp-admin/admin-ajax.php?action=fetch_chatbot_users&page=${page}`)
                .then(response => {
                // console.log('Response:', response.data);
                // Update the component's data
                this.userData = response.data.user_data;
                this.currentPage = response.data.current_page;
                this.totalPages = response.data.total_pages; // Update total pages
                this.loading = false; // Reset loading state
            })
                .catch(error => {
                // console.error('Error fetching data:', error);
                this.loading = false; // Reset loading state on error
            });
        },
        loadPage(page) {
            // console.log('loadPage called with page:', page);
            // Ensure page is within valid range
            if (page >= 1 && page <= this.totalPages) {
                this.fetchUsers(page);
            }
        },
    },
    components: { LeadsNew }
};


</script>



  
  <style scoped>
.admin-table {
  width: 50%; /* Make the table 50% narrower */
  border-collapse: collapse;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.admin-table th, .admin-table td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.admin-table th {
  background-color: #3498db; /* Blue header */
  color: #fff;
}

.data-row:hover {
  background-color: #f39c12; /* Orange on hover */
  transition: background-color 0.3s;
}

.pagination {
  margin-top: 20px;
  text-align: center;
}

.pagination button {
  background-color: #27ae60; /* Green buttons */
  color: #fff;
  padding: 8px 16px;
  border: none;
  cursor: pointer;
  margin: 0 4px;
  transition: background-color 0.3s;
}

.pagination button:hover {
  background-color: #2ecc71; /* Lighter green on hover */
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