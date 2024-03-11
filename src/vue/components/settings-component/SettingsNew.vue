<template>
<div>
    <div class="app">
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
                                        <a href="" class="text-decoration-none">Link Account <span><i class="fa-solid fa-arrow-right"></i></span></a>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="./image/chat_complierX_icon.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="d-flex align-items-center h-100">
                        <div class="api_token_box d-flex align-items-center  p-3">
                            <div class="api_token  w-100">
                                <h5>Enter API Token</h5>
                                <p>Link your account to CompilerX to get the API Key</p>
                                <div class="d-flex align-items-center">
                                    <form @submit.prevent="submitApiSettings">
                                        <input v-model="apiToken" name="api_token" placeholder="Enter API Token" class="form-control" />
                                        <button type="submit" class="btn btn-primary mt-2">Save Settings</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="profile_image shadow-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <h5 class="text_style">Profile Image</h5>
                                <p class="text_p">Link your account to CompilerX to get the API Key</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <div class="profile_box d-flex align-items-center justify-content-center">
                                    <img src="./image/chat_proifle.png" alt="">
                                </div>
                                <button class="upload_button ms-4 border-0">Upload Image</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="api_token  w-100 mt-4">
                                <h5>Enter API Token</h5>
                                <p>Link your account to CompilerX to get the API Key</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="api_token  w-100 ">
                                <div class="d-flex align-items-center">
                                    <input type="text" placeholder="Enter your API Key" class="me-2 w-100 px-3 py-2">
                                    <input type="submit" value="Save">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            profilePicture: null, // Initialize with data from API
            userNameBot: "", // Initialize with data from API

            profilePictureInput: null,
            apiToken: "",
            // endpointUrl: '../wp-admin/admin-ajax.php?action=chatbot_handle_settings_submission', // Define the endpoint URL
        };
    },
    // computed: {
    //   endpointUrl() {
    //     return '../wp-admin/admin-ajax.php?action=chatbot_handle_settings_submission';
    //   },
    // },
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
                        alert(response.data.data);
                        // You can update the user's name in the component's data if needed
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
                        alert(response.data.data);
                        // You can update the API token in the component's data if needed
                    } else {
                        alert("Error saving API settings");
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
                    alert(response.data.data);
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

    },
};
</script>

<style scoped>
.gen_seting {
    color: #2C384A;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: 0.18px;
}

.api_token_box,
.chat_settings {
    border-radius: 10px;
    background-color: #fff;
    padding: 20px 0px;
    min-height: 173px;
    width: 100%;
}

.api_token h5,
.chat_link_avccount h5 {
    color: #2C384A;
    font-size: 20px;
    font-weight: 500;
}

.api_token p,
.chat_link_avccount p {
    color: #2C384A;
    font-size: 12px;
    font-weight: 400;
}

.chat_link_avccount a {
    color: #FFF;
    font-size: 14px;
    font-weight: 500;
    border-radius: 4px;
    background: linear-gradient(90deg, #007BD9 0%, rgba(0, 145, 255, 0.70) 100%), #007BD9;
    padding: 8px 22px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
}

.api_token input[type="text"]::placeholder {
    font-size: 12px;
}

.api_token input[type="text"] {
    background-color: #F0F4F7;
    border: 0px;
    font-size: 14px;
    outline: none;
    border-radius: 5px;
}

.api_token input[type="submit"] {
    border-radius: 5px;
    background-color: #007BD9;
    display: inline-flex;
    padding: 8px 22px;
    justify-content: center;
    align-items: center;
    gap: 16px;
    color: #FFF;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    border: 0px;
}

.text_style {
    color: #2C384A;
    font-size: 20px;
    font-weight: 500;
}

.text_p {
    color: #2C384A;
    font-size: 12px;
    font-weight: 400;
}

.profile_image {
    width: 100%;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
}

.profile_box {
    width: 142px;
    height: 142px;
    border-radius: 100px;
}

.upload_button {
    color: #FFF;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    border-radius: 4px;
    background: linear-gradient(90deg, #007BD9 0%, rgba(0, 145, 255, 0.70) 100%), #007BD9;
    display: inline-flex;
    padding: 8px 22px;
    justify-content: center;
    align-items: center;
}
</style>
