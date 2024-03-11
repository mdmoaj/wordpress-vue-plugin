<template>
<div>

    <div class="col-12">
        <div class="when_ask shadow-lg py-4 w-100">
            <div class="api_token  w-100 ">
                <h5 class="mb-0">Send Lead Alert <i class="fa-solid fa-circle-info circle_info"></i>
                </h5>
                <div class="d-flex align-items-center mt-4">
                    <input type="text" name="lead_alert" v-model="LeadAlert" placeholder="Enter your email id" class="me-3 w-100 px-3 py-2" />
                    <input type="submit" @click="submitLeadAlert()" value="Save">
                </div>
            </div>
            <div class="mt-4">
                <div class="table-responsive">
                    <table class="lead_alert w-100">
                        <thead>
                            <tr>
                                <th>
                                    <div>
                                        <p>Added Id’s</p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr v-for="(email_address, index) in emailAddresses" :key="index">
                                    <td>{{ email_address }}</td>
                                    <td>
                                        <div class="custom_icon d-flex align-items-center justify-content-end">
                                            <button><i class="fa-solid fa-pencil"></i></button>
                                            <button><i class="fa-regular fa-trash-can"></i></button>
                                        </div>
                                    </td>
                                </tr> -->

                            <tr v-for="(email_address, index) in emailAddresses" :key="index">
                                <td>
                                    <span v-if="!email_address.editing">{{ email_address }}</span>
                                    <input v-else v-model="email_address.newValue" @keyup.enter="saveEditedEmail(index)" />
                                </td>
                                <td>
                                    <div class="custom_icon d-flex align-items-center justify-content-end">
                                        <button @click="startEditing(index)"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></button>
                                        <button @click="deleteEmail(index)"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
import Swal from 'sweetalert2';
import axios from "axios";
export default {
    data() {
        return {
            LeadAlert: null,
            emailAddresses: []

        };
    },

    components: {

    },
    mounted() {
        // Call a function to fetch and populate email addresses when the component is mounted
        this.fetchEmailAddresses();
    },

    methods: {

        submitLeadAlert() {
            // Email validation using a regular expression
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(this.LeadAlert)) {
                // Invalid email format, show an error message or alert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid email format. Please enter a valid email address.',
                    // footer: '<a href="">Why do I have this issue?</a>'
                })
                // alert("Invalid email format. Please enter a valid email address.");
                return;
            }

            // Check if the email already exists in the emailAddresses array
            if (this.emailAddresses.includes(this.LeadAlert)) {
                // alert("Email already exists. Please enter a different email address.");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Email already exists. Please enter a different email address.',
                    // footer: '<a href="">Why do I have this issue?</a>'
                })
                return;
            }

            // Continue with the API call if the email is valid and not already in the list
            const endpointUrl = "../wp-admin/admin-ajax.php?action=handle_lead_alert_saving";

            axios
                .get(endpointUrl, {
                    params: {
                        lead_alert: this.LeadAlert,
                    },
                })
                .then((response) => {
                    if (response.data.success) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Lead saved successfully',
                            
                            showConfirmButton: true,
                            timer: 1500
                        });
                        // Add the new email to the list if it's saved successfully
                        this.emailAddresses.push(this.LeadAlert);
                    } else {
                        alert("Error saving Email Address");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        },

        fetchEmailAddresses() {
            // Make an AJAX request to fetch email addresses from the server
            axios.get('../wp-admin/admin-ajax.php?action=fetch_email_addresses')
                .then(response => {
                    this.emailAddresses = response.data; // Assuming response is an array of email addresses
                    console.log('email address'.this.emailAddresses);
                })
                .catch(error => {
                    console.error('Error fetching email addresses:', error);
                });
        },
        startEditing(index) {
            // Set 'editing' to true for the selected email
            this.emailAddresses[index].editing = true;
        },

        saveEditedEmail(index) {
            // Save the edited email address to the server and update the 'editing' property
            const editedEmail = this.emailAddresses[index].newValue;
            axios.post('../wp-admin/admin-ajax.php?action=update_email_address', {
                    email: editedEmail
                })
                .then(() => {
                    this.emailAddresses[index] = editedEmail; // Update the email directly in the array
                    this.emailAddresses[index].editing = false;
                })
                .catch(error => {
                    console.error('Error updating email address:', error);
                });
        },
        deleteEmail(index) {
            const emailToDelete = this.emailAddresses[index];
            axios
                .get('../wp-admin/admin-ajax.php?action=delete_email_address&email=' + emailToDelete)
                .then(() => {
                    this.emailAddresses.splice(index, 1);

                    Swal.fire({
                        position: 'center', // Center the dialog
                        icon: 'success',
                        title: 'Email ID Deleted successfully',
                        showConfirmButton: true,
                        timer: 1500
                    });
                })
                .catch(error => {
                    console.error('Error deleting email address:', error);
                });
        },

    }
};
</script>
