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
                    <NewUsers/>
                    

                </div>
                <div class="col-lg-6 col-xl-7">

                  <Traffic/>

                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <Leads/>
            </div>
        </div>
   


        

</div>
</template>

<script>
// import Chart from 'chart.js';
// import NewUsers from '../Dashboard-component/NewUsers.vue';
// import Traffic from '../Dashboard-component/Traffic.vue';
import NewUsers from './NewUsers.vue';
import Traffic from './Traffic.vue';
import Leads from './Leads.vue';


export default {
   
    methods: {
        toggleLeads() {
            // Add your logic to toggle leads here
            this.$refs.leadsBox.classList.toggle('active');
            this.$refs.leadTable.classList.toggle('active');
            this.$refs.tableResponsive.classList.toggle('active');
            this.$refs.seeAll.classList.toggle('active');
        }
    },
    components: {  NewUsers, Traffic, Leads }
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

.new_users,.leads_box {
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
.table_responsive.active{
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
.pagination ul li p{
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

.pagination ul li button:hover{
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