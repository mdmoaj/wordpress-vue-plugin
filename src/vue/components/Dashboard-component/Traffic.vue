<template>
    <div class="new_users shadow-lg d-flex flex-column justify-content-between">
        <div class="new_users_child d-flex align-items-center justify-content-between">
            <div>
                <h3 class="mb-0">Traffic</h3>
                <select class="form-select" aria-label="Default select example" v-model="selectedOption">
                    <option value="0">Last Three Months</option>
                    <option value="1">Last Six Months</option>
                    <option value="2">Last Year</option>
                    <option value="3">Lifetime</option>
                </select>
                <button class="btn btn-primary" @click="updateChart">Apply</button>
            </div>

            <a href="">
                <span>
                    live
                </span>
            </a>
        </div>

        <div>
            <canvas class="pt-4 pb-3" ref="chart" style="height:100%;" ></canvas>
            <!-- <canvas class="py-4" id="bars"></canvas> -->
            <!-- style="max-height: 274px !important; height: 100% !important;" -->

        </div>

    </div>
</template>


  
<script>
import Chart from 'chart.js';
import axios from 'axios';

export default {
    data() {
        return {
            chart: null,
            loading: false,
            userData: [],
            selectedOption: 0, // Default selected option
            timeOptions: [
                'Last Three Months',
                'Last Six Months',
                'Last Year',
                'Lifetime'
            ]
        };
    },
    mounted() {
        this.fetchUsers();
    },
    methods: {
       fetchUsers() {
            // Fetch users based on the selected time period (this.selectedOption)
            const timePeriods = ['last_three_months', 'last_six_months', 'last_year', 'lifetime'];
            const selectedTimePeriod = timePeriods[this.selectedOption];
            
            this.loading = true;
            axios
                .get(
                    `../wp-admin/admin-ajax.php?action=fetch_chatbot_users&timePeriod=${selectedTimePeriod}`
                )
                .then((response) => {
                    if (response.data.user_data) {
                        this.userData = response.data.user_data;
                        this.aggregateDataAndRenderChart();
                    }
                    this.loading = false;
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                    this.loading = false;
                });
        },
        aggregateDataAndRenderChart() {
            // ... (your existing aggregation logic)
        },
        aggregateDataAndRenderChart() {
            // Create an object to store user counts for each month
            const monthCounts = {};

            // Loop through the user data and count users for each month
            this.userData.forEach((user) => {
                const timestamp = new Date(user.timestamp);
                const month = timestamp.getMonth(); // Get the month (0-11)
                const year = timestamp.getFullYear(); // Get the year

                // Use the month and year as a key and increment the count
                const key = `${year}-${month}`;
                if (!monthCounts[key]) {
                    monthCounts[key] = 0;
                }
                monthCounts[key]++;
            });

            // Extract and sort the labels (months) and data (user counts)
            const labels = Object.keys(monthCounts).sort();
            const data = labels.map((key) => monthCounts[key]);

            this.renderChart(labels, data);
        },
        renderChart(labels, data) {
            if (this.chart) {
                this.chart.destroy();
            }

            const ctx = this.$refs.chart.getContext('2d');

            this.chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    "labels": labels,
                    "datasets": [
                        {
                            "label": 'User Count',
                            "data": data,
                            backgroundColor: 'blue',
                            borderColor: '#007BD9',
                            borderRadius: 20,
                            innerWidth: 5
                        },

                    //     {
                    //     "label": "Backlog",
                    //     "data": data,
                    //     backgroundColor: ['#A4D5FA'],
                    //     borderColor: '#007BD9',
                    //     borderRadius: 20,
                    // },
                    ],
                },



              






                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month',
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'User Count',
                            },
                        },
                    },
                },
            });
        },
    },
};
</script>
  



<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');



</style>