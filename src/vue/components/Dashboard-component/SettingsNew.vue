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
                                        <a href="" class="text-decoration-none">Link Account <span><i class="fa-solid fa-arrow-right"></i></span></a>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <!-- <img src="./image/chat_complierX_icon.png" class="img-fluid" alt=""> -->
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
                                    <input type="text" placeholder="Enter your API Key" class="me-2 w-100 px-3 py-2">
                                    <input type="submit" value="Save">
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
                                    <!-- <img src="./image/chat_proifle.png" alt=""> -->
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
</template>

<script>

</script>

<style scoped>

</style>
