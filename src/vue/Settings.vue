<template>
<div>
    <div class="container pt-5">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <h1 class="heading_text mb-0">Settings</h1>
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
        <p class="gen_seting">General Settings</p>
        <div class="row g-3">
            <div class="col-lg-5">
                <div class="shadow-lg chat_settings">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <div class="chat_link_avccount">
                                    <h5>Link your Account</h5>
                                    <p>Link your account to CompilerX to get the API Key</p>
                                    <a href="https://www.compilerx.com/sign-up" class="text-decoration-none">Link Account <span><i class="fa-solid fa-arrow-right"></i></span></a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <img :src="'../../assets/images/chat_complierX_icon.png'" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="d-flex align-items-center h-100">
                    <div class="api_token_box  shadow-lg d-flex align-items-center  p-3">
                        <div class="api_token  w-100">
                            <h5>Enter API Token</h5>
                            <!-- <p>Link your account to CompilerX to get the API Key, vist here for the key: <a href="https://www.compilerx.com/settings">compilerx.com/settings</a></p> -->
                            <p>Link your account to CompilerX to get the API Key, visit here for the key: <a href="https://www.compilerx.com/settings">compilerx.com/settings</a></p>

                            <div class="d-flex align-items-center">

                                <input type="text" v-model="apiToken" name="api_token" placeholder="Enter your API Key" class="me-2 w-100 px-3 py-2" />
                                <input @click="submitApiSettings()" type="submit" value="Save">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="col-12 mt-5 mb-5">
            <div class="d-flex align-items-center h-100">
                <div class="api_token_box  shadow-lg d-flex align-items-center  p-3">
                    <div class="api_token  w-100">
                        <h5>Welcome Message</h5>
                        <!-- <p>Link your account to CompilerX to get the API Key, vist here for the key: <a href="https://www.compilerx.com/settings">compilerx.com/settings</a></p> -->
                        <!-- <p>Link your account to CompilerX to get the API Key, visit here for the key: <a href="https://www.compilerx.com/settings">compilerx.com/settings</a></p> -->

                        <div class="d-flex align-items-center">

                            <input type="text" v-model="welcomeMessage" name="welcome_message" placeholder="Enter here the Welcome Message" class="me-2 w-100 px-3 py-2" />
                            <input @click="submitwelcomeMessage()" type="submit" value="Save">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_image shadow-lg pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <h5 class="text_style">Profile Image</h5>
                            <p class="text_p">Link your account to CompilerX to get the API Key</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-sm-flex align-items-center">
                            <div class="profile_box d-flex align-items-center justify-content-center">
                                <label for="fileInput">
                                    <img :src="'../../assets/images/chat_proifle.png'" alt="">
                                </label>
                                <input enctype="multipart/form-data" type="file" ref="profilePictureInput" id="fileInput" style="display: none;" @change="onProfilePictureChange">
                            </div>
                            <button @click="submitProfilePicture" class="upload_button mt-3 mt-0 ms-sm-4 border-0">Upload Image</button>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="api_token  w-100 mt-4">
                            <h5 class="mb-0">Chatbot Name</h5>
                            <p>This name will be showcase as Chatbot’s name</p>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-2">
                        <div class="api_token  w-100 ">
                            <div class="d-flex align-items-center">
                                <input v-model="userNameBot" name="user_name_bot" type="text" placeholder="Enter your chatbot’s name here" class="me-3 w-100 px-3 py-2" />
                                <input @click="submitUserName" type="submit" value="Update Name">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h4 class="customer mb-3">
            Customer Intake Settings
        </h4>
        <div class="row g-3">
            <div class="col-lg-7">
                <GeneralFields />
            </div>
            <div class="col-lg-5">

                <div class="row justify-content-center align-items-center g-3">

                    <ChatbotCounter />

                    <LeadAlert/>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

    
<script>
import Swal from 'sweetalert2';
import axios from "axios";
import ChatbotCounter from "./components/settings-component/ChatbotCounter.vue";
import GeneralFields from "./components/settings-component/GeneralFields.vue";
import LeadAlert from "./components/settings-component/LeadAlert.vue";

export default {
    data() {
        return {
            profilePicture: null, // Initialize with data from API
            userNameBot: "", // Initialize with data from API

            profilePictureInput: null,
            apiToken: "",
            welcomeMessage: "",

            // endpointUrl: '../wp-admin/admin-ajax.php?action=chatbot_handle_settings_submission', // Define the endpoint URL
        };
    },
    // computed: {
    //   endpointUrl() {
    //     return '../wp-admin/admin-ajax.php?action=chatbot_handle_settings_submission';
    //   },
    // },
    components: {
    ChatbotCounter,
    GeneralFields,
    LeadAlert
},
    created() {
        // Create the event bus when the component is created

    },

    methods: {

        submitUserName() {
            const endpointUrl =
                "../wp-admin/admin-ajax.php?action=chatbot_handle_name_submission";

            axios
                .get(endpointUrl, {
                    params: {
                        user_name_bot: this.userNameBot, // Change 'user_name' to 'user_name_bot'
                    },
                })
                .then((response) => {
                    if (response.data.success) {
                        Swal.fire({
                            position: 'center', // Center the dialog
                            icon: 'success',
                            title: 'Chatbot Name Updated successfully',
                            showConfirmButton: true,
                            timer: 1500
                        });
                    } else {
                        alert("Error updating name");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });

        },

        submitApiSettings() {
            const endpointUrl =
                "../wp-admin/admin-ajax.php?action=handle_api_settings_submission";

            axios
                .get(endpointUrl, {
                    params: {
                        api_token: this.apiToken,
                    },
                })
                .then((response) => {
                    if (response.data.success) {
                        Swal.fire({
                            position: 'center', // Center the dialog
                            icon: 'success',
                            title: 'API Token saved successfully',
                            showConfirmButton: true,
                            timer: 1500
                        });
                    } else {
                        alert("Error saving API settings");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        },
        submitwelcomeMessage() {

            const endpointUrl =
                "../wp-admin/admin-ajax.php?action=handle_welcomeMSG_settings_submission";

            axios
                .get(endpointUrl, {
                    params: {
                        welcome_message: this.welcomeMessage,
                    },
                })
                .then((response) => {
                    if (response.data.success) {
                        Swal.fire({
                            position: 'center', // Center the dialog
                            icon: 'success',
                            title: 'Welcome Message saved successfully',
                            showConfirmButton: true,
                            timer: 1500
                        });

                    } else {
                        alert("Error saving Welcome Message");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });

        },

        onProfilePictureChange(event) {
            this.profilePictureInput = event.target.files[0];
        },
        async submitProfilePicture() {
            const formData = new FormData();
            formData.append("profile_picture", this.profilePictureInput);

            try {
                const response = await axios.post(
                    "../wp-admin/admin-ajax.php?action=chatbot_handle_profile_picture_submission",
                    formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );

                if (response.data.success) {
                    this.profilePicture = response.data.profile_picture_url;
                    Swal.fire({
                            position: 'center', // Center the dialog
                            icon: 'success',
                            title: 'Profile Photo saved successfully',
                            showConfirmButton: true,
                            timer: 1500
                        });
                } else {
                    alert("Error updating profile picture");
                }
            } catch (error) {
                console.error("Error updating profile picture:", error);
            }
        },
        //   async submitUserName() {
        //     try {
        //       const response = await axios.post('/your-backend-endpoint', {
        //         user_name: this.userName
        //       });

        //       this.userName = response.data.user_name;
        //     } catch (error) {
        //       console.error('Error saving user name:', error);
        //     }
        //   },
        //   submitApiSettings() {
        // // Define the endpoint URL relative to your Vue component's location
        // const endpointUrl = '/wordpress_test/wordpressvue/wp-admin/admin-ajax.php?action=chatbot_handle_settings_submission';
        //       // Send an AJAX request to the WordPress endpoint
        //       axios
        //           .post(endpointUrl, {
        //               api_token: this.apiToken,
        //           })
        //           .then((response) => {
        //               // Handle the response here
        //               console.log('this is thetribute',response.data.message);
        //           })
        //           .catch((error) => {
        //               // Handle errors here
        //               console.error(error);
        //           });
        //   },

    }
};
</script>

    
<style scoped>

        </style>
