<template>
<div>

    <div class="col-12">
        <div class="when_ask shadow-lg pt-4 pb-5 w-100">
            <div class="api_token  w-100 ">
                <h5 class="mb-0">When to ask?</h5>
                <p>When should the intake form appear in the chatbot?</p>
            </div>
            <div>
                <div class="customer_immediately d-flex align-items-center">
                    <input class="me-2" type="radio" id="flexRadioDefault2">
                    <label for="flexRadioDefault2">
                        Immediately
                    </label>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <div class="customer_immediately d-flex align-items-center me-3">
                        <input class="me-2" type="radio" id="flexRadioDefault2">
                        <label for="flexRadioDefault2">
                            Immediately
                        </label>
                    </div>
                    <form @submit.prevent="submitCounterSettings()">
                        <div class=" customer_select d-flex align-items-center">
                            <select v-model="selectedOption" class="me-1" name="selectedOption" id="selectedOption">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                            <label for="selectedOption">questions</label>
                        </div>
                        <div class="mt-4">
                            <input class="customer_table_submit" type="submit" value="Save">
                        </div>
                    </form>

                    <form @submit.prevent="submitSecondCounterSettings()">
                        <div class=" customer_select d-flex align-items-center">
                            <select v-model="selectedOptiontwo" class="me-1" name="selectedOptiontwo" id="selectedOptiontwo">
                                <option>6</option>
                                <option>8</option>
                                <option>10</option>
                                <option>12</option>
                            </select>
                            <label for="selectedOptiontwo">questions</label>
                        </div>
                        <div class="mt-4">
                            <input class="customer_table_submit" type="submit" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            selectedOption: null, // Set a default value
            selectedOptiontwo: null,
        };
    },
    methods: {

        submitCounterSettings() {
            // event.preventDefault();
            const endpointUrl =
                "../wp-admin/admin-ajax.php?action=chatbot_response_trigger_form";

            axios
                .get(endpointUrl, {
                    params: {
                        selectedOption: this.selectedOption,
                    },
                })
                .then((response) => {
                    if (response.data.success) {
                        Swal.fire({
                            position: 'center', // Center the dialog
                            icon: 'success',
                            title: 'Change the form Response',
                            showConfirmButton: true,
                            timer: 1500
                        });
                    } else {
                        alert("Error saving Counter settings");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        },

        submitSecondCounterSettings() {

            // event.preventDefault();
            const endpointUrl =
                "../wp-admin/admin-ajax.php?action=chatbot_response_trigger_form_two";

            axios
                .get(endpointUrl, {
                    params: {
                        selectedOptiontwo: this.selectedOptiontwo,
                    },
                })
                .then((response) => {
                    if (response.data.success) {
                        Swal.fire({
                            position: 'center', // Center the dialog
                            icon: 'success',
                            title: 'Change the form Response',
                            showConfirmButton: true,
                            timer: 1500
                        });
                    } else {
                        alert("Error saving Counter settings");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });

        },

    },
};
</script>
