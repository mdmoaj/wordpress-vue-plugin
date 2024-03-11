<template>
    <div>


        <div class="container pt-5">
            <div class="row">
                <div class="col-6">
                    <h1 class="heading_text mb-0">Chatbot Dashboard</h1>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end">
                    <div class="Chatbot_serarch_box d-flex align-items-center justify-content-center shadow-sm">
                        <button class="me-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                        <input type="search" placeholder="search" name="" id="">
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row g-3">
                <div class="col-lg-6 col-xl-5">
                    <NewUsers />


                </div>
                <div class="col-lg-6 col-xl-7">

                    <Traffic />

                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <Leads />
            </div>
        </div>

        <!-- <p>Viewport Width: {{ viewportWidth }}</p>
    <p>Window Scroll Width: {{ windowScrollWidth }}</p> -->

    </div>
</template>

<script>
// import Chart from 'chart.js';
// import NewUsers from '../Dashboard-component/NewUsers.vue';
// import Traffic from '../Dashboard-component/Traffic.vue';
import '../../../css/index.css';
import '../../../css/responsive.css';

import NewUsers from './NewUsers.vue';
import Traffic from './Traffic.vue';
import Leads from './Leads.vue';


export default {
//     data() {
//     return {
//       viewportWidth: 0,
//       windowScrollWidth: 0,
//     };
//   },
//   mounted() {
//     // Update the viewportWidth and windowScrollWidth when the component is mounted
//     this.updateWidths();

//     // Listen for window resize events to update the values when the window size changes
//     window.addEventListener('resize', this.updateWidths);
//   },
//   beforeDestroy() {
//     // Remove the resize event listener when the component is destroyed to prevent memory leaks
//     window.removeEventListener('resize', this.updateWidths);
//   },
    methods: {
        toggleLeads() {
            // Add your logic to toggle leads here
            this.$refs.leadsBox.classList.toggle('active');
            this.$refs.leadTable.classList.toggle('active');
            this.$refs.tableResponsive.classList.toggle('active');
            this.$refs.seeAll.classList.toggle('active');
        },

    //     updateWidths() {
    //   // Update the viewportWidth and windowScrollWidth values
    //   this.viewportWidth = window.innerWidth;
    //   this.windowScrollWidth = window.scrollWidth;
    // },
    },
    components: { NewUsers, Traffic, Leads }
};
</script>




<style scoped>

</style>