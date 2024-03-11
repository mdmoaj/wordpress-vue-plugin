<?php






// Start or resume the session


// Get the session ID or generate a new one
// $session_id = session_id();


// $session_id = get_option('custom_session_id', '');


// function sessionIDinJavascript($session_id)
// {

//     echo '<script>';
//     echo 'var sessionIdNew = "' . ($session_id ? esc_html($session_id) : 'custom_session_id') . '";';

//     echo '</script>';


// }




// Log the session ID
// error_log('Session ID Latest: ' . $session_id);


// update_option('custom_session_id', $session_id);

$session_id = get_option('custom_session_id', '');

//   echo '<script>';

//   echo 'var session_id = "' . ($_SESSION ? esc_html($_SESSION) : 'custom_session_id') . '";';

//   echo '</script>';





// function chatbot_display_interface()
// {
//     // $session_id = get_option('custom_session_id', '');
//     // $session_id = get_option('custom_session_id', '');
//     // $latestSeassion = $session_id;

//     // update_option('session_id_new', $latestSeassion);

//     // $latestSeassion = get_option('session_id_new', '');

//     session_start();
//     session_regenerate_id();

//     $session_id = session_id();

//     update_option('sessionIdNew', $session_id);




//     $profile_picture = get_option('profile_picture', '');
//     $user_name_bot = get_option('user_name_bot', '');
//     $welcomeMsg = get_option('welcome_message', '');

//     $selectedOptiontwo = get_option('selectedOptiontwo', '');

//     $selectedOption = get_option('selectedOption', '');


//     //Form Logic
//     $selectedname = get_option('selected name', '');
//     $selectedemail = get_option('selected email', '');
//     $selectedphone = get_option('selected phone', '');
//     $selectedcompany = get_option('selected company', '');
//     $selectedjob = get_option('selected job_titles', '');
//     $selectedaddress = get_option('selected address', '');
//     $selectedDOB = get_option('selected birth_date', '');
//     $selectedGender = get_option('selected gender', '');
//     //convert the value string to integer
//     $numericValueName = intval($selectedname);
//     $numericValueEmail = intval($selectedemail);
//     $numericValuePhone = intval($selectedphone);
//     $numericValueCompany = intval($selectedcompany);
//     $numericValueJob = intval($selectedjob);
//     $numericValueAddress = intval($selectedaddress);
//     $numericValueDOB = intval($selectedDOB);
//     $numericValueGender = intval($selectedGender);

//     $allFiled = $numericValueName + $numericValueEmail + $numericValuePhone + $numericValueCompany + $numericValueJob + $numericValueAddress + $numericValueDOB + $numericValueGender;


//     $requiredAttribute1 = $numericValueName ? 'required' : '';
//     $requiredAttribute2 = $numericValueEmail ? 'required' : '';
//     $requiredAttribute3 = $numericValueCompany ? 'required' : '';
//     $requiredAttribute4 = $numericValueJob ? 'required' : '';
//     $requiredAttribute5 = $numericValueAddress ? 'required' : '';
//     $requiredAttribute6 = $numericValueDOB ? 'required' : '';
//     $requiredAttribute7 = $numericValueGender ? 'required' : '';
//     $requiredAttribute8 = $numericValuePhone ? 'required' : '';

//     $profile_picture = get_option('profile_picture', '');

//     error_log('profile picture' . $profile_picture);


//     echo '<script>';
//     echo 'var sessionIdNew = "' . ($session_id ? esc_html($session_id) : 'custom_session_id') . '";';
//     // echo 'var imageUrl = "' . esc_url($profile_picture) . '";';
//     echo 'var imageUrl = "' . ($profile_picture ? esc_html($profile_picture) : 'profile picture') . '";';
//     echo 'var userName = "' . ($user_name_bot ? esc_html($user_name_bot) : 'Your Name') . '";';
//     echo 'var welcomeMsg = "' . ($welcomeMsg ? esc_html($welcomeMsg) : 'welcome message') . '";';
//     echo 'var selectedOptiontwo = "' . ($selectedOptiontwo ? esc_html($selectedOptiontwo) : 'selectedOptiontwo') . '";';
//     echo 'var selectedOption = "' . ($selectedOption ? esc_html($selectedOption) : 'selectedOption') . '";';
//     echo '</script>';
//     echo '<button class="chatboat_message_open" id="chatbot-icons">';
//     echo '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#000040}</style><path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z"/></svg>';
//     echo '</button>';
//     echo '<div class="ai_chatboard_box_app" id="chatbot-container">';
//     echo '<div class="ai_chatboard_box  position-relative shadow-sm pb-3">';
//     echo '<div class="ai_over_layout">';
//     echo '<div class="position-relative h-100">';
//     echo '<button class="fa_xmark">';
//     echo '<i class="fa-solid fa-xmark"></i>';
//     echo '</button>';
//     echo '<div class="ai_over_content">';
//     echo '<img src="' . esc_url($profile_picture) . '" class="welcomeImage" alt="">';
//     echo '<p class="content_p1 mb-0">Welcome To</p>';
//     echo '<h2 class="content_h2">' . ($user_name_bot ? esc_html($user_name_bot) : 'Your Name') . '</h2>';
//     echo '<p class="mt-5 text-center content_p2">An AI powered Smart ChatBot <br> from COMPILERX</p>';
//     echo '</div>';
//     echo '<button class="ai_start_btn" id="getStartedButton">';
//     echo 'Get Started';
//     echo '</button>';
//     echo '</div>';
//     echo '</div>';

//     //header
//     echo '<header class="d-flex align-items-center justify-content-between">';
//     echo '<div class="d-flex align-items-center">';
//     echo '<img src=" ' . esc_url($profile_picture) . ' " alt="">';
//     echo '<p class="mb-0 ms-2 ms-sm-3">' . ($user_name_bot ? esc_html($user_name_bot) : 'Your Name') . '</p>';
//     echo '</div>';
//     echo '<div class="d-flex align-items-center">';
//     // echo '<button class="me-3 me-sm-4">';
//     // echo '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM169.8 165.3c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 13-10.9 23.6-24 23.6c-13.3 0-24-10.7-24-24V250.5c0-8.6 4.6-16.5 12.1-20.8l44.3-25.4c4.7-2.7 7.6-7.7 7.6-13.1c0-8.4-6.8-15.1-15.1-15.1H222.6c-3.4 0-6.4 2.1-7.5 5.3l-.4 1.2c-4.4 12.5-18.2 19-30.6 14.6s-19-18.2-14.6-30.6l.4-1.2zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>';
//     // echo '</button>';
//     echo '<button class="me-3 me-sm-4"id="refresh-icon" >';
//     echo '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M142.9 142.9c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5c0 0 0 0 0 0H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5c7.7-21.8 20.2-42.3 37.8-59.8zM16 312v7.6 .7V440c0 9.7 5.8 18.5 14.8 22.2s19.3 1.7 26.2-5.2l41.6-41.6c87.6 86.5 228.7 86.2 315.8-1c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.2 62.2-162.7 62.5-225.3 1L185 329c6.9-6.9 8.9-17.2 5.2-26.2s-12.5-14.8-22.2-14.8H48.4h-.7H40c-13.3 0-24 10.7-24 24z"/></svg>';
//     echo '</button>';
//     echo '<button class="fa_xmark" id="close-icon">';
//     echo '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>';
//     echo '</button>';
//     echo '</div>';
//     echo '</header>';


//     ///body
//     echo '<div class="ai_chatboard_box_body" id="scroll"   >';
//     echo '<div class="ai_chatboard_scroll" id="chatbot-messages">';
//     // echo '<div id="user-input-res">';
//     echo '<div>';

//     echo '<div id="chatbot-messagesSend">';
//     echo '</div>';

//     echo '<div class="d-flex justify-content-start" >';
//     echo '<div class="send_ai_icon" >';
//     echo '<img src="' . esc_url($profile_picture) . ' " class="" alt="">';
//     echo '</div>';
//     echo '<div class=" ms-3"  >';
//     echo '<h5 class="send_h5">' . ($user_name_bot ? esc_html($user_name_bot) : 'Your Name') . '</h5>';
//     echo '<p class="mb-0 send_p">';
//     echo ' ' . ($welcomeMsg ? esc_html($welcomeMsg) : 'welcome message') . ' ';
//     echo '</p>';
//     echo '</div>';
//     echo '</div>';
//     echo '</div>';
//     echo '<div class="my-3">';
//     echo '<div class="d-flex align-items-center justify-content-end ms-3">';
//     // echo '<p class="mb-0 response_p">';
//     // echo 'Give me the contact number of Klizos';
//     // echo '</p>';
//     // echo '<div id="form-confirmation" style="display: none;">';
//     // echo '<div class="d-flex justify-content-start" >';
//     // echo '<div class="send_ai_icon ">';
//     // echo '<img src="' .  esc_url($profile_picture)  . ' " class="" alt="">';
//     // echo '</div>';
//     // echo '<div class=" ms-3">';
//     // echo '<h5 class="send_h5">Compbot</h5>';
//     // echo '<p  class="mb-0 send_p">';
//     // echo 'Sure mate! before that please fill up this form so I can give the results more accurately.';
//     // echo '</p>';
//     // echo '</div>';
//     // echo '</div>';






//     // echo '</div>';
//     echo '</div>';
//     echo '</div>';
//     echo '</div>';
//     echo '<div id="form-confirmation" style="display: none;">';
//     echo '<div class="d-flex justify-content-start"  >';
//     echo '<div class="send_ai_icon " ' . ($allFiled ? '' : 'style="display: none;"') . '>';
//     echo '<img src="' . esc_url($profile_picture) . ' " alt="">';
//     echo '</div>';
//     echo '<div class=" ms-3" ' . ($allFiled ? '' : 'style="display: none;"') . '>';
//     // echo '<h5 class="send_h5">Compbot</h5>';
//     echo '<p  class="mb-0 send_p">';
//     echo 'Sure mate! before that please fill up this form so I can give the results more accurately.';
//     echo '</p>';
//     echo '</div>';
//     echo '</div>';






//     echo '</div>';


//     //Form Logic
//     $selectedname = get_option('selected name', '');
//     $selectedemail = get_option('selected email', '');
//     $selectedphone = get_option('selected phone', '');
//     $selectedcompany = get_option('selected company', '');
//     $selectedjob = get_option('selected job_titles', '');
//     $selectedaddress = get_option('selected address', '');
//     $selectedDOB = get_option('selected birth_date', '');
//     $selectedGender = get_option('selected gender', '');
//     //convert the value string to integer
//     $numericValueName = intval($selectedname);
//     $numericValueEmail = intval($selectedemail);
//     $numericValuePhone = intval($selectedphone);
//     $numericValueCompany = intval($selectedcompany);
//     $numericValueJob = intval($selectedjob);
//     $numericValueAddress = intval($selectedaddress);
//     $numericValueDOB = intval($selectedDOB);
//     $numericValueGender = intval($selectedGender);

//     $allFiled = $numericValueName + $numericValueEmail + $numericValuePhone + $numericValueCompany + $numericValueJob + $numericValueAddress + $numericValueDOB + $numericValueGender;


//     // // $requiredAttribute1 = $numericValueName ? 'required' : '';
//     // $requiredAttribute2 = $numericValueEmail ? 'required' : '';
//     // // $requiredAttribute9 = $numericValuePhone ? 'required' : '';
//     // $requiredAttribute3 = $numericValueCompany ? 'required' : '';
//     // $requiredAttribute4 =  $numericValueJob ? 'required' : '';
//     // $requiredAttribute5 = $numericValueAddress ? 'required' : '';
//     // $requiredAttribute6 = $numericValueDOB ? 'required' : '';
//     // $requiredAttribute7 =  $numericValueGender ? 'required' : '';
//     // $requiredAttribute8 = $numericValuePhone ? 'required' : '';


//     $optionRequired = get_option('name_field_status', '');
//     $optionRequiredemail = get_option('selected required email', '');
//     $optionRequiredphone = get_option('phone_field_status', '');
//     $optionRequiredcompany = get_option('company_field_status', '');
//     $optionRequiredjob_titles = get_option('job_titles_field_status', '');
//     $optionRequiredaddress = get_option('address_field_status', '');
//     $optionRequiredbirth_date = get_option('birth_date_field_status', '');
//     $optionRequiredgender = get_option('gender_field_status', '');


//     // error_log('optional selected', $optionRequired);

//     if ($optionRequired == 1) {
//         $requiredAttribute1 = $numericValueName ? 'required' : '';
//     } else {
//         $requiredAttribute1 = 0;
//     }
//     if ($optionRequiredemail == 1) {
//         $requiredAttribute2 = $numericValueEmail ? 'required' : '';
//     } else {
//         $requiredAttribute2 = 0;
//     }
//     if ($optionRequiredphone == 1) {
//         $requiredAttribute8 = $numericValuePhone ? 'required' : '';
//     } else {
//         $requiredAttribute8 = 0;
//     }
//     if ($optionRequiredcompany == 1) {
//         $requiredAttribute3 = $numericValueCompany ? 'required' : '';
//     } else {
//         $requiredAttribute3 = 0;
//     }
//     if ($optionRequiredjob_titles == 1) {
//         $requiredAttribute4 = $numericValueJob ? 'required' : '';
//     } else {
//         $requiredAttribute4 = 0;
//     }
//     if ($optionRequiredaddress == 1) {
//         $requiredAttribute5 = $numericValueAddress ? 'required' : '';
//     } else {
//         $requiredAttribute5 = 0;
//     }
//     if ($optionRequiredbirth_date == 1) {
//         $requiredAttribute6 = $numericValueDOB ? 'required' : '';
//     } else {
//         $requiredAttribute6 = 0;
//     }
//     if ($optionRequiredgender == 1) {
//         $requiredAttribute7 = $numericValueGender ? 'required' : '';
//     } else {
//         $requiredAttribute7 = 0;
//     }








//     // $requiredAttribute1 = $optionRequired;  


//     echo '<script>';
//     echo 'var allFormData = "' . ($allFiled ? esc_html($allFiled) : 'name') . '";';
//     echo 'var nameForm = "' . ($numericValueName ? esc_html($numericValueName) : 'name') . '";';
//     echo 'var emailForm = "' . ($numericValueEmail ? esc_html($numericValueEmail) : 'email') . '";';
//     echo 'var phoneForm = "' . ($numericValuePhone ? esc_html($numericValuePhone) : 'phone') . '";';
//     echo 'var companyForm = "' . ($numericValueCompany ? esc_html($numericValueCompany) : 'company') . '";';
//     echo 'var jobForm = "' . ($numericValueJob ? esc_html($numericValueJob) : 'job') . '";';
//     echo 'var addressForm = "' . ($numericValueAddress ? esc_html($numericValueAddress) : 'address') . '";';
//     echo 'var dobForm = "' . ($numericValueDOB ? esc_html($numericValueDOB) : 'dob') . '";';
//     echo 'var genderForm = "' . ($numericValueGender ? esc_html($numericValueGender) : 'gender') . '";';
//     echo '</script>';
//     echo '<div class="ps-2" ' . ($allFiled ? '' : 'style="display: none;"') . '>';

//     echo '<form id="chatbot-form" class="ai_chatboard_form mt-3" style="display: none;">';
//     echo '<svg  style="cursor: pointer;" id="formCloseButton" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>';
//     echo '<div id="name-container" ' . ($numericValueName ? '' : 'style="display: none;"') . '>';
//     echo '<input ' . $requiredAttribute1 . ' type="text" id="name" name="name" placeholder="Full Name">';
//     echo '</div>';
//     echo '<div id="email-container" ' . ($numericValueEmail ? '' : 'style="display: none;"') . '>';
//     echo '<input ' . $requiredAttribute2 . '  type="email" id="email" name="email" placeholder="Email">';
//     echo '</div>';
//     echo '<div id="phone-container" ' . ($numericValuePhone ? '' : 'style="display: none;"') . '>';
//     echo '<input ' . $requiredAttribute8 . '  type="tel" id="phone"  name="phone" placeholder="Number">';
//     echo '</div>';
//     echo '<div id="company-container" ' . ($numericValueCompany ? '' : 'style="display: none;"') . '>';
//     echo '<input ' . $requiredAttribute3 . '  type="text" id="company" name="company" placeholder="Company">';
//     echo '</div>';
//     echo '<div id="job-container" ' . ($numericValueJob ? '' : 'style="display: none;"') . '>';
//     echo '<input ' . $requiredAttribute4 . ' type="text" id="job" name="job" placeholder="Job">';
//     echo '</div>';
//     echo '<div id="address-container" ' . ($numericValueAddress ? '' : 'style="display: none;"') . '>';
//     echo '<input ' . $requiredAttribute5 . ' type="text" id="address" name="address" placeholder="Address">';
//     echo '</div>';
//     echo '<div id="dob-container" ' . ($numericValueDOB ? '' : 'style="display: none;"') . '>';
//     echo '<input ' . $requiredAttribute6 . ' type="text" id="dob" name="dob" placeholder="Date of Birth">';
//     echo '</div>';

//     // Gender select field
//     // echo '<label for="gender">Gender:</label>';
//     echo '<select ' . $requiredAttribute7 . ' id="gender" name="gender" ' . ($numericValueGender ? '' : 'style="display: none;"') . '>';
//     echo '<option value="Male">Male</option>';
//     echo '<option value="Female">Female</option>';
//     echo '<option value="Other">Other</option>';
//     echo '</select>';

//     echo '<button type="submit" id="submit-btn" ' . ($allFiled ? '' : 'style="display: none;"') . '>Submit<span class="loader"></span></button>';
//     echo '</form>';
//     echo '</div>';
//     // form


//     echo '</div>';
//     echo '<div class="ai_chatboard_box_footer mt-3">';
//     echo '<div class="search_box position-relative">';
//     echo '<input type="search" name="" id="chatbot-input" placeholder="Enter your message">';
//     echo '<button id="send-btn" class="send_btn">';
//     echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"';
//     echo 'class="bi bi-send" viewBox="0 0 16 16">';
//     echo '<path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>';
//     echo '</svg>';
//     echo '</button>';
//     echo '</div>';
//     echo '</div>';
//     echo '</div>'; // Closing div for ai_chatboard_box_body
//     echo '</div>'; // Closing div for ai_chatboard_box
//     echo '</div>'; // Closing div for ai_chatboard_box_app

// }

// add_action('wp_footer', 'chatbot_display_interface');
// add_action('wp_ajax_chatbot_display_interface', 'chatbot_display_interface');
// add_action('wp_ajax_nopriv_chatbot_display_interface', 'chatbot_display_interface');


function chatbot_save_user_name()
{
    if (isset($_POST['submit_user_name'])) {
        $current_user_id = get_current_user_id();
        $user_name = sanitize_text_field($_POST['user_name']);

        // Save the user name in user meta
        update_user_meta($current_user_id, 'user_name', $user_name);

    }
    wp_redirect($_SERVER['HTTP_REFERER']); // Redirect back to the previous page after form submission
    exit;
}
add_action('admin_post_chatbot_handle_name_submission', 'chatbot_save_user_name');
add_action('admin_post_nopriv_chatbot_handle_name_submission', 'chatbot_save_user_name');




//This function to get id to store the id in conversations table




//Database Connection

// function chatbot_store_conversation($prompt, $bot_response, $email, $phone)
// {
//     $session_id = get_option('theSessionID', '');
//         // error_log('the session ID' . $session_id);

//     // $user_email = $email;
//     // $user_id = get_user_id_by_email($user_email);

//     $user_email = $email;
//     $country = get_country_by_email($user_email);


//     $user_email = $email;
//     $countryCode = get_countryCode_by_email($user_email);

//     $user_email = $email;
//     $regionName = get_regionName_by_email($user_email);

//     $user_email = $email;
//     $city = get_city_by_email($user_email);

//     $user_email = $email;
//     $zip = get_zip_by_email($user_email);

//     $user_email = $email;
//     $IP = get_IP_by_email($user_email);


//     if (empty($user_email)) {
//         $updated_id = $session_id;
//     }

//     if (empty($name)) {
//         // Set user_id to null when email is not present
//         $name = 'Anonymous';
//     }

//     // error_log("email id", $email);
//     // dd($user_name);
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'chatbot_conversations';

//     // $current_user = wp_get_current_user();
//     // $user_id = $current_user->ID; // Get the User ID
//     // $user_name = $current_user->display_name; // Get the user's display name
//     if (!empty($updated_id)) {
//         // Update all rows with the same session_id to have the same updated_id
//         $wpdb->update(
//             $table_name,
//             array('updated_id' => $updated_id),
//             array('session_id' => $session_id),

//         );
//         $ids = $updated_id; 
//     }


//     if (!empty($name)) {
//         // Update all rows with the same session_id to have the same user_name
//         $wpdb->update(
//             $table_name,
//             array('user_name' => $name),
//             array('session_id' => $session_id)
//         );
//     }

//     // Check if user_email is not empty
//     if (!empty($email)) {
//         // Update all rows with the same session_id to have the same user_email
//         $wpdb->update(
//             $table_name,
//             array('user_email' => $email),
//             array('session_id' => $session_id)
//         );
//     }

//     // Check if user_email is not empty
//     if (!empty($email)) {
//         // Update all rows with the same session_id to have the same user_email
//         $wpdb->update(
//             $table_name,
//             array('user_email' => $email),
//             array('session_id' => $session_id)
//         );
//     }




//     $data = array(

//         // 'user_id' => $user_id, // Ensure 'ids' is treated as a string
//         'updated_id' => $session_id,
//         'session_id' => $session_id,
//         'user_name' => $name,
//         'user_message' => $prompt,
//         // 'user_phone' => $phone,
//         // 'email' => $email,
//         'user_email' => $email,
//         'bot_response' => $bot_response,
//         'country' => $country,
//         'countryCode' =>  $countryCode,
//         'regionName' => $regionName,
//         'city' => $city,
//         'zip' => $zip,
//         'IP' => $IP,

//         'timestamp' => current_time('mysql'),
//     );
//     error_log("this is IDS" . json_encode($data));

//     $wpdb->insert($table_name, $data);



// }

function get_ip_address()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
}


// Store user details in the database
function chatbot_store_user_details()
{
    $latestSeassion = get_option('session_id_new', '');
    $session_id = $latestSeassion;

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $company = sanitize_text_field($_POST['company']);
    $job = sanitize_text_field($_POST['job']);
    $address = sanitize_text_field($_POST['address']);
    $dob = sanitize_text_field($_POST['dob']);
    $gender = sanitize_text_field($_POST['gender']);



    // Add debugging statement to check the values being received
    // error_log("Name: $name, Email: $email, Phone: $phone");

    // Get the user's IP address
    $user_ip = '122.182.198.203';
    // error_log("IP: $user_ip");

    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $data = array(
        'session_id' => $session_id,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'company' => $company,
        'job' => $job,
        'addres' => $address,
        'dob' => $dob,
        'gender' => $gender,

    );

    $wpdb->insert($table_name, $data);

    if ($wpdb->insert_id) {
        // Retrieve IP details from the API
        $api_url = 'http://ip-api.com/json/' . $user_ip;
        $response = wp_safe_remote_get($api_url);


        if (!is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response);
            $ip_data = json_decode($body, true);

            if (isset($ip_data['status']) && $ip_data['status'] === 'success') {
                // Update the user's IP details in the database
                $wpdb->update(
                    $table_name,
                    array(
                        'country' => sanitize_text_field($ip_data['country']),
                        'countryCode' => sanitize_text_field($ip_data['countryCode']),
                        'regionName' => sanitize_text_field($ip_data['regionName']),
                        'city' => sanitize_text_field($ip_data['city']),
                        'zip' => sanitize_text_field($ip_data['zip']),
                        'IP' => $user_ip,
                    ),
                    array('id' => $wpdb->insert_id)

                );
            }
        }

        if ($wpdb->insert_id) {
            // Prepare data for API call
            $api_data = array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
            );

            // API endpoint and token
            $api_token_settings = get_option('api_token', '');
            $api_endpoint = 'https://dev.compilerx.com/api/auth/leads';
            $api_token = $api_token_settings;

            // Create a new cURL resource
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $api_endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $api_token,
                )
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($api_data));

            // Execute cURL and get response
            $api_response = curl_exec($ch);

            // Close cURL resource
            curl_close($ch);

            // Handle API response
            if ($api_response !== false) {
                $api_response_data = json_decode($api_response, true);
                if (isset($api_response_data['_id'])) {
                    wp_send_json_success('User details stored and API call successful.');
                } else {
                    wp_send_json_error('User details stored, but API call failed.');
                }
            } else {
                wp_send_json_error('Failed to store user details or make API call.');
            }
        } else {
            wp_send_json_error('Failed to store user details.');
        }
    }
}


add_action('wp_ajax_chatbot_store_user_details', 'chatbot_store_user_details');
add_action('wp_ajax_nopriv_chatbot_store_user_details', 'chatbot_store_user_details');

// Plugin activation hook
function chatbot_plugin_activate()
{
    chatbot_create_database_table();
    chatbot_create_conversations_table();

    // Get the current domain URL
    $domain_url = get_site_url();

    // Store the domain URL in an option or database table
    update_option('custom_domain_url', $domain_url);

    validate_url_run();
    get_details_run();
    flush_rewrite_rules();
}



register_activation_hook(__FILE__, 'chatbot_plugin_activate');

// Create the database table on plugin activation
function chatbot_create_database_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        session_id VARCHAR(100) NOT NULL,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        company VARCHAR(50) NOT NULL,
        job VARCHAR(50) NOT NULL,
        addres VARCHAR(50) NOT NULL,
        dob VARCHAR(50) NOT NULL,
        gender VARCHAR(50) NOT NULL,
        country VARCHAR(100) NOT NULL,
        countryCode VARCHAR(100) NOT NULL,
        regionName VARCHAR(100) NOT NULL,
        city VARCHAR(100) NOT NULL,
        zip VARCHAR(20) NOT NULL,
        IP VARCHAR(50) NOT NULL,
        timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function chatbot_create_conversations_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_conversations';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        user_id VARCHAR(100) DEFAULT NULL,
        session_id VARCHAR(100) NOT NULL,
        updated_id VARCHAR(100) DEFAULT NULL,
        user_name VARCHAR(100) NOT NULL,
        user_message TEXT(10000) NOT NULL,
        bot_response TEXT (10000)NOT NULL,
        user_email VARCHAR(100) DEFAULT NULL,
        phone VARCHAR(50) DEFAULT NULL,
        country VARCHAR(100) DEFAULT NULL,
        countryCode VARCHAR(100) DEFAULT NULL,
        regionName VARCHAR(100) DEFAULT NULL,
        city VARCHAR(100) DEFAULT NULL,
        zip VARCHAR(20) DEFAULT NULL,
        IP VARCHAR(50) DEFAULT NULL,
        timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


function chatbot_create_send_Lead_Alert_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_send_lead_alert';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        email_address VARCHAR(100) NOT NULL,
        timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}



function chatbot_get_api_url()
{
    return get_option('chatbot_api_url', '');
}

// Function to get the saved API token from the database using WordPress Settings API
function chatbot_get_api_token()
{
    return get_option('chatbot_api_token', '');
}


// Process user input and generate chatbot responses
function chatbot_process_input()
{




    $latestSeassion = get_option('session_id_new', '');
    // 


    // $user_name_bot = get_option('user_name_bot', '');
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $user_name_bot = get_option('user_name_bot', '');
    $name = sanitize_text_field($_POST['name']);


    $domain_url = get_option('custom_domain_url'); //current site url

    $parsed_url = parse_url($domain_url);
    $naked_domain = $parsed_url['host'];  //for remove the http protocol


    update_option('custom_naked_domain_url', $naked_domain);




    $domain = 'compilerx.com';
    $bot_name = $user_name_bot;
    $prompt = sanitize_text_field($_POST['user_message']);


    // $user_name = sanitize_text_field($_POST['user_name']);
    // $prompt = sanitize_text_field($_POST['user_message']);
    // $api_url = 'https://api.openai.com/v1/chat/completions'; // Use the static API URL

    $api_token_settings = get_option('api_token', '');

    $api_url = 'https://dev.compilerx.com/api/auth/chatbot';
    $api_token = $api_token_settings;
    // error_log("API URL: $api_url, API Token: $api_token");
    $api_token = get_option('api_token');
    $headers = array(
        'Authorization' => 'Bearer ' . $api_token,
        // Use the correct variable $api_token
        'Content-Type' => 'application/json',
    );
    $payload = array(
        // 'model' => 'gpt-3.5-turbo',
        'domain' => $domain,
        'prompt' => $prompt,
        'bot_name' => $bot_name,


        // 'user_message' => $prompt
        // array(
        //     // array('role' => 'system', 'content' => 'You are a helpful assistant.'),
        //     // array('role' => 'user', 'content' => $prompt),
        // ),
    );

    $request_args = array(
        'headers' => $headers,
        'body' => wp_json_encode($payload),
    );


    $response = wp_remote_post($api_url, $request_args);
    error_log("error response raw data update: " . json_encode($response));

    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        $response_data = wp_remote_retrieve_body($response);

        error_log("raw response" . $response_data);
        error_log(" response raw data update: " . json_encode($response_data));
        // Split the response data into separate JSON strings
        $response_parts = explode('}{', $response_data);

        // Extract the first response part
        $first_response_part = $response_parts[0];

        // Add a closing curly brace to make the JSON valid
        $first_response_part = rtrim($first_response_part, '}') . '}';

        // Decode the first response part
        $decoded_data = json_decode($first_response_part, true); // true parameter to convert to associative array

        // Check if the required fields are present in the decoded data
        if (isset($decoded_data['response']) && isset($decoded_data['prompt'])) {
            $response_final = $decoded_data['response'];
            $prompt = $decoded_data['prompt'];

            error_log("error msg final d3: $response_final ");
            // error_log("prompt: $prompt");

            // Assuming the structure of the inner data is as follows
            $bot_response = $response_final;
            error_log("bot responseee: $bot_response ");
            // error_log("bot_response: $bot_response");
            $session_id = $latestSeassion;
            // error_log("session id: $session_id ");
        }
        // error_log("Before chatbot_store_conversation: $prompt, $bot_response");
        chatbot_store_conversation($prompt, $bot_response, $session_id, $email);
        // error_log("After chatbot_store_conversation");

        wp_send_json_success($bot_response);
        // error_log("bot_response: $bot_response");
    } else {
        $error_message = "I'm not sure!";
        if (is_wp_error($response)) {
            $error_message .= ' Error: ' . $response->get_error_message();
        }

        // Store the user request and error message in the database
        // chatbot_store_conversation($user_name, $prompt, $error_message);

        wp_send_json_error($error_message);
    }
}

// Hook for AJAX request handling
add_action('wp_ajax_chatbot_process_input', 'chatbot_process_input');
add_action('wp_ajax_nopriv_chatbot_process_input', 'chatbot_process_input');



function chatbot_send_input($session_id)
{
    // $session_id= get_option('custom_session_id', '');
    // error_log('Session ID chatbot_send input: ' . $session_id);

    $domain_url = 'compilerx.com'; //current site url

    $parsed_url = parse_url($domain_url);
    // $naked_domain = $parsed_url['host'];  //for remove the http protocol
    // $session_id = get_option('custom_session_id');

    // update_option('custom_naked_domain_url', $naked_domain);


    $name = sanitize_text_field($_POST['name']);
    $user_name_bot = get_option('user_name_bot', '');

    $prompt = sanitize_text_field($_POST['user_message']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $bot_name = $user_name_bot;

    $session_id = sanitize_text_field($_POST['sessionId']);
    $name = sanitize_text_field($_POST['userName']);

    error_log("chatbot user nameeeeeeeeeeeeeeeeeeeeeeeeeeeeee" . $name);
    update_option('theSessionID', $session_id);

    // $latestSeassion = get_option('session_id_new', '');

    $domain = 'techforus.in';
    // Send user input to the server
    $response = wp_remote_post(
        admin_url('admin-ajax.php'),
        array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array(),
            'body' => array('action' => 'chatbot_process_input', 'user_message' => $prompt, 'name' => $name, 'email' => $email, 'phone' => $phone, 'bot_name' => $bot_name, 'sessionId' => $session_id),
            'cookies' => array(),
        )
    );

    if (!is_wp_error($response)) {
        $bot_response = wp_remote_retrieve_body($response);
        wp_send_json_success($bot_response);
    } else {
        wp_send_json_error('Failed to communicate with the server.');
    }
}
add_action('wp_ajax_chatbot_send_input', 'chatbot_send_input');
add_action('wp_ajax_nopriv_chatbot_send_input', 'chatbot_send_input');




function get_user_id_by_email($email)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $query = $wpdb->prepare("SELECT id FROM $table_name WHERE email = %s", $email);
    $user_id = $wpdb->get_var($query);

    return $user_id;
}
function get_country_by_email($email)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $query = $wpdb->prepare("SELECT country FROM $table_name WHERE email = %s", $email);
    $country = $wpdb->get_var($query);

    return $country;
}

function get_countryCode_by_email($email)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $query = $wpdb->prepare("SELECT countryCode FROM $table_name WHERE email = %s", $email);
    $countryCode = $wpdb->get_var($query);

    return $countryCode;
}
function get_regionName_by_email($email)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $query = $wpdb->prepare("SELECT regionName FROM $table_name WHERE email = %s", $email);
    $regionName = $wpdb->get_var($query);

    return $regionName;
}
function get_city_by_email($email)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $query = $wpdb->prepare("SELECT city FROM $table_name WHERE email = %s", $email);
    $city = $wpdb->get_var($query);

    return $city;
}
function get_zip_by_email($email)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $query = $wpdb->prepare("SELECT zip FROM $table_name WHERE email = %s", $email);
    $zip = $wpdb->get_var($query);

    return $zip;
}

function get_IP_by_email($email)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $query = $wpdb->prepare("SELECT IP FROM $table_name WHERE email = %s", $email);
    $IP = $wpdb->get_var($query);

    return $IP;
}

function get_name_by_email($email)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $query = $wpdb->prepare("SELECT name FROM $table_name WHERE email = %s", $email);
    $user_name = $wpdb->get_var($query);

    return $user_name;
}
function get_phone_by_email($email)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $query = $wpdb->prepare("SELECT phone FROM $table_name WHERE email = %s", $email);
    $user_phone = $wpdb->get_var($query);

    return $user_phone;
}

function chatbot_store_conversation($prompt, $bot_response, $email, $phone)
{
    $session_id = get_option('theSessionID', '');
    error_log('the session ID' . $session_id);

    // Retrieve existing data based on session_id
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_conversations';
    $existing_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE session_id = %s ORDER BY timestamp DESC LIMIT 1", $session_id));

    // Declare $user_name outside of the "if-else" block and set a default value
    $user_name = 'Test User Data';

    // Check if existing data with the same session_id and no email
    if (!$existing_data || empty($existing_data->user_email)) {
        // If no existing data or the latest row has no email, update or insert the data
        $user_email = sanitize_email($_POST['email']);
        error_log('email user latest' . $user_email);

        $user_id = get_user_id_by_email($user_email);
        $IP = get_IP_by_email($user_email);
        $user_name = get_name_by_email($user_email);
        // If name is empty, set it as 'Anonymous'
        if (empty($user_name)) {
            $user_name = 'Anonymous';
        }
        $user_country = get_country_by_email($user_email);
        $user_countryCode = get_countryCode_by_email($user_email);
        $user_regionName = get_regionName_by_email($user_email);
        $user_city = get_city_by_email($user_email);
        $user_zip = get_zip_by_email($user_email);
        $user_phone = get_phone_by_email($user_email);

        $data = array(
            'user_id' => $user_id,
            'updated_id' => $session_id,
            'session_id' => $session_id,
            'user_name' => $user_name,
            'user_message' => $prompt,
            'phone' => $user_phone,
            'user_email' => $user_email,
            'bot_response' => $bot_response,
            'country' => $user_country,
            'countryCode' => $user_countryCode,
            'regionName' => $user_regionName,
            'city' => $user_city,
            'zip' => $user_zip,
            'IP' => $IP,
            'timestamp' => current_time('mysql'),
        );
        error_log("this is conversation insert value" . json_encode($data));

        $wpdb->insert($table_name, $data);
    } else {
        // Update the latest row with the same session_id data
        $data = array(
            'user_id' => $existing_data->user_id,
            'user_name' => $existing_data->user_name,
            'user_email' => $existing_data->user_email,
            'phone' => $existing_data->phone,
            'country' => $existing_data->country,
            'countryCode' => $existing_data->countryCode,
            'regionName' => $existing_data->regionName,
            'city' => $existing_data->city,
            'zip' => $existing_data->zip,
            'IP' => $existing_data->IP,
            'timestamp' => current_time('mysql'),
        );

        $where = array('session_id' => $session_id);
        $wpdb->update($table_name, $data, $where);
    }


}






// AJAX handler for sending user input and receiving bot responses
