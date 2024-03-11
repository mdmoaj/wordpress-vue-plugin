<?php
// Include necessary WordPress files
// require_once('../wp-load.php');


// Define the function to fetch and return user data
function fetch_chatbot_users_leads() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    $items_per_page = 10;
    $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($current_page - 1) * $items_per_page;

    // Query for the current page
    $user_data = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table_name LIMIT %d OFFSET %d", $items_per_page, $offset)
    );

     // Query to count the total number of users
     $total_user_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");

    // Prepare and return the response
    $response = array(
        'user_data' => $user_data,
        'total_user_count' => $total_user_count,
        'current_page' => $current_page,
        // Other data you might need
    );

    echo json_encode($response);
    wp_die(); // Terminate the request
}

// Hook the function to an AJAX action
add_action('wp_ajax_fetch_chatbot_users_leads', 'fetch_chatbot_users_leads');
add_action('wp_ajax_nopriv_fetch_chatbot_users_leads', 'fetch_chatbot_users_leads'); // For non-logged in users

function fetch_chatbot_users() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    // $items_per_page = 10;
    // $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    // $offset = ($current_page - 1) * $items_per_page;

    // Query for the current page
    $user_data = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $table_name ORDER BY timestamp DESC")
    );

     // Query to count the total number of users
     $total_user_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");

    // Prepare and return the response
    $response = array(
        'user_data' => $user_data,
        'total_user_count' => $total_user_count,
        // 'current_page' => $current_page,
        // Other data you might need
    );

    echo json_encode($response);
    wp_die(); // Terminate the request
}

// Hook the function to an AJAX action
add_action('wp_ajax_fetch_chatbot_users', 'fetch_chatbot_users');
add_action('wp_ajax_nopriv_fetch_chatbot_users', 'fetch_chatbot_users'); // For non-logged in users
function fetch_conversations() {
    // error_log("Inside feacth conversations");
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_conversations';
    $conversations = $wpdb->get_results("SELECT * FROM $table_name ORDER BY timestamp DESC");

    wp_send_json_success($conversations);
}
add_action('wp_ajax_fetch_conversations', 'fetch_conversations');
add_action('wp_ajax_nopriv_fetch_conversations', 'fetch_conversations');



//This is for User Name Submission in Menu setting page


add_action('wp_ajax_chatbot_handle_name_submission', 'chatbot_handle_name_submission');
add_action('wp_ajax_nopriv_chatbot_handle_name_submission', 'chatbot_handle_name_submission');

function chatbot_handle_name_submission() {
    if (isset($_GET['user_name_bot'])) {
        // Sanitize and process the user_name_bot parameter
        $user_name_bot = sanitize_text_field($_GET['user_name_bot']);
        
        // Get the current user's ID
        $current_user_id = get_current_user_id();

        // Update the user's display name (user_login is used as display name by default)
        wp_update_user(array(
            'ID' => $current_user_id,
            'display_name' => $user_name_bot
        ));
        update_option('user_name_bot', $user_name_bot);
        // error_log('user nam', $user_name_bot);
        // Return a response
        $response = array(
            'success' => true,
            'data' => 'Name updated successfully.'
        );
    } else {
        $response = array(
            'success' => false,
            'data' => 'Invalid data received.'
        );
    }

    wp_send_json($response);
}
function get_user_name_bot() {
    $name = get_option('user_name_bot');

    if (empty($name)) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => 'Name not found.'
        ), 404); // Or another appropriate error code
    }

    return new WP_REST_Response(array(
        'success' => true,
        'name' => $name 
    ), 200);
}   


//photo upload
add_action('wp_ajax_chatbot_handle_profile_picture_submission', 'chatbot_handle_profile_picture_submission');
add_action('wp_ajax_nopriv_chatbot_handle_profile_picture_submission', 'chatbot_handle_profile_picture_submission');


function chatbot_handle_profile_picture_submission() {
    if (isset($_FILES['profile_picture'])) {
        $current_user_id = get_current_user_id();
        $file = $_FILES['profile_picture'];
        $upload_overrides = array('test_form' => false);
        $uploaded_file = wp_handle_upload($file, $upload_overrides);

        if ($uploaded_file && !isset($uploaded_file['error'])) {
            // Save the profile picture URL in user meta
            // update_user_meta($current_user_id, 'profile_picture', $uploaded_file['url']);
            update_option('profile_picture', $uploaded_file['url']);
            
            $response = array(
                'success' => true,
                'data' => 'Profile picture updated successfully.',
                'profile_picture_url' => $uploaded_file['url']
            );
        } else {
            $response = array(
                'success' => false,
                'data' => 'Error updating profile picture.'
            );
        }
    } else {
        $response = array(
            'success' => false,
            'data' => 'Invalid data received.'
        );
    }

    wp_send_json($response);
}
function add_cors_http_header() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
}

add_action('init', 'add_cors_http_header');

//This is for API save




//For register users or all users present in database

add_action('wp_ajax_get_total_user_count', 'get_total_user_count');
add_action('wp_ajax_nopriv_get_total_user_count', 'get_total_user_count');

function get_total_user_count() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_user_details';

    // Query to count the total number of users
    $total_user_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");

    echo json_encode(array('total_user_count' => $total_user_count));
    wp_die();
}



add_action('wp_ajax_handle_api_settings_submission', 'handle_api_settings_submission');
add_action('wp_ajax_nopriv_handle_api_settings_submission', 'handle_api_settings_submission');

function handle_api_settings_submission() {
    if (isset($_GET['api_token'])) {
        // Sanitize and process the api_token parameter
        $api_token = sanitize_text_field($_GET['api_token']);
        // error_log("Api tokens" . $api_token);
        // Save the API token or perform other actions as needed
        update_option('api_token', $api_token);
       

        // Return a response
        $response = array(
            'success' => true,
            'data' => 'API settings saved successfully.'
        );
    } else {
        $response = array(
            'success' => false,
            'data' => 'Invalid data received.'
        );
    }

    wp_send_json($response);
}

// 
function chatbot_response_trigger_form() {
    // Check if the selectedOption parameter is present and not empty
    if (isset($_GET['selectedOption']) && !empty($_GET['selectedOption'])) {
        // Sanitize and process the selectedOption parameter
        $selectedOption = sanitize_text_field($_GET['selectedOption']);
        // error_log("Selected Option: " . $selectedOption);

        // Update the option using the WordPress REST API
        update_option('selectedOption', $selectedOption);



        // Prepare the response including the selectedOption value
        $response = array(
            'success' => true,
            'data' => 'Counter settings saved successfully.',
            'selectedOption' => $selectedOption // Include selectedOption in the response
        );
    } else {
        // Invalid data received
        $response = array(
            'success' => false,
            'data' => 'Invalid data received. selectedOption parameter is missing or empty.'
        );
    }

    wp_send_json($response);
}

add_action('wp_ajax_chatbot_response_trigger_form', 'chatbot_response_trigger_form');
add_action('wp_ajax_nopriv_chatbot_response_trigger_form', 'chatbot_response_trigger_form');


function chatbot_response_trigger_form_two() {
    // Check if the selectedOption parameter is present and not empty
    if (isset($_GET['selectedOptiontwo']) && !empty($_GET['selectedOptiontwo'])) {
        // Sanitize and process the selectedOptiontwo parameter
        $selectedOptiontwo = sanitize_text_field($_GET['selectedOptiontwo']);
        // error_log("Selected Option: " . $selectedOptiontwo);

        // Update the option using the WordPress REST API
        update_option('selectedOptiontwo', $selectedOptiontwo);


  











        // Prepare the response including the selectedOptiontwo value
        $response = array(
            'success' => true,
            'data' => 'Counter settings saved successfully.',
            'selectedOptiontwo' => $selectedOptiontwo // Include selectedOptiontwo in the response
        );
    } else {
        // Invalid data received
        $response = array(
            'success' => false,
            'data' => 'Invalid data received. selectedOptiontwo parameter is missing or empty.'
        );
    }

    wp_send_json($response);
}

add_action('wp_ajax_chatbot_response_trigger_form_two', 'chatbot_response_trigger_form_two');
add_action('wp_ajax_nopriv_chatbot_response_trigger_form_two', 'chatbot_response_trigger_form_two');

function chatbot_display_from_test() {
   
    if ($_GET['fieldName'] === 'name') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "name" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message


        update_option('selected name', $value);


        // error_log('name value for true or false check', $value);
        if ($value === '1') {
            echo json_encode(['message' => 'Name field is now active']);
        } else {
            echo json_encode(['message' => 'Name field is now inactive']);
        }
    }
    
    // Repeat the above logic for other fields (email, phone, etc.)
    
    // Handle the request for the "email" field
    if ($_GET['fieldName'] === 'email') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('selected email', $value);
        
        if ($value === '1') {
            echo json_encode(['message' => 'Email field is now active']);
        } else {
            echo json_encode(['message' => 'Email field is now inactive']);
        }
    }

    if ($_GET['fieldName'] === 'phone') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('selected phone', $value);

        if ($value === '1') {
            echo json_encode(['message' => 'Email field is now active']);
        } else {
            echo json_encode(['message' => 'Email field is now inactive']);
        }
    }

    if ($_GET['fieldName'] === 'company') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('selected company', $value);

        if ($value === '1') {
            echo json_encode(['message' => 'company field is now active']);
        } else {
            echo json_encode(['message' => 'company field is now inactive']);
        }
    }
    if ($_GET['fieldName'] === 'job_titles') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('selected job_titles', $value);

        if ($value === '1') {
            echo json_encode(['message' => 'job_titles field is now active']);
        } else {
            echo json_encode(['message' => 'job_titles field is now inactive']);
        }
    }
    if ($_GET['fieldName'] === 'address') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('selected address', $value);

        if ($value === '1') {
            echo json_encode(['message' => 'address field is now active']);
        } else {
            echo json_encode(['message' => 'address field is now inactive']);
        }
    }

    if ($_GET['fieldName'] === 'birth_date') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('selected birth_date', $value);

        if ($value === '1') {
            echo json_encode(['message' => 'birth_date field is now active']);
        } else {
            echo json_encode(['message' => 'birth_date field is now inactive']);
        }
    }

    if ($_GET['fieldName'] === 'gender') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('selected gender', $value);

        if ($value === '1') {
            echo json_encode(['message' => 'gender field is now active']);
        } else {
            echo json_encode(['message' => 'gender field is now inactive']);
        }
    }




}

add_action('wp_ajax_chatbot_display_from_test', 'chatbot_display_from_test');
add_action('wp_ajax_nopriv_chatbot_display_from_test', 'chatbot_display_from_test');






function handle_welcomeMSG_settings_submission() {
    if (isset($_GET['welcome_message'])) {
        // Sanitize and process the api_token parameter
        $welcome_message = sanitize_text_field($_GET['welcome_message']);
        // error_log("Welcome Message" . $welcome_message);
        // Save the API token or perform other actions as needed
        update_option('welcome_message', $welcome_message);
       

        // Return a response
        $response = array(
            'success' => true,
            'data' => 'Welcome Message saved successfully.'
        );
    } else {
        $response = array(
            'success' => false,
            'data' => 'Invalid data received.'
        );
    }

    wp_send_json($response);
}
add_action('wp_ajax_handle_welcomeMSG_settings_submission', 'handle_welcomeMSG_settings_submission');
add_action('wp_ajax_nopriv_handle_welcomeMSG_settings_submission', 'handle_welcomeMSG_settings_submission');



// Lead Alert Saving




function handle_lead_alert_saving() {
    global $wpdb; // Access WordPress database functions

    if (isset($_GET['lead_alert'])) {
        // Sanitize and process the lead_alert parameter
        $lead_alert = sanitize_email($_GET['lead_alert']);

        // Check if the email already exists in the database
        if (email_exists($lead_alert)) {
            $response = array(
                'success' => false,
                'data' => 'Email Address already exists in the database.'
            );
        } else {
            // Insert data into the chatbot_send_lead_alert table
            $table_name = $wpdb->prefix . 'chatbot_send_lead_alert'; // Prefix for WordPress tables
            $data = array('email_address' => $lead_alert); // Define the data to insert

            $wpdb->insert($table_name, $data); // Insert the data

            // Check if the insert was successful
            if ($wpdb->last_error) {
                $response = array(
                    'success' => false,
                    'data' => 'Error saving data: ' . $wpdb->last_error
                );
            } else {
                $response = array(
                    'success' => true,
                    'data' => 'Email Address saved successfully.'
                );
            }
        }
    } else {
        $response = array(
            'success' => false,
            'data' => 'Invalid data received.'
        );
    }

    wp_send_json($response);
}


add_action('wp_ajax_handle_lead_alert_saving', 'handle_lead_alert_saving');
add_action('wp_ajax_nopriv_handle_lead_alert_saving', 'handle_lead_alert_saving');


function fetch_email_addresses() {
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_send_lead_alert'; // Replace with your table name

    // Query to fetch email addresses
    $query = "SELECT email_address FROM $table_name";
    $results = $wpdb->get_results($query);

    if (!empty($results)) {
        $email_addresses = array();
        foreach ($results as $result) {
            $email_addresses[] = $result->email_address;
        }

        // Return email addresses as JSON
        wp_send_json($email_addresses);
    } else {
        wp_send_json(array()); // Return an empty array if no email addresses found
    }
}

add_action('wp_ajax_fetch_email_addresses', 'fetch_email_addresses');
add_action('wp_ajax_nopriv_fetch_email_addresses', 'fetch_email_addresses');


//edit and delete the lead alert

function update_email_address() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_send_lead_alert'; // Replace with your table name

    if (isset($_POST['email_address'])) {
        $email = sanitize_email($_POST['email_address']);
        $id = intval($_POST['id']); // Assuming you pass an ID to identify the row to update

        // Update the email address in the database
        $wpdb->update(
            $table_name,
            array('email_address' => $email),
            array('id' => $id),
            array('%s'),
            array('%d')
        );

        // Check if the update was successful
        if ($wpdb->last_error) {
            wp_send_json(array(
                'success' => false,
                'message' => 'Error updating email address: ' . $wpdb->last_error,
            ));
        } else {
            wp_send_json(array(
                'success' => true,
                'message' => 'Email address updated successfully.',
            ));
        }
    } else {
        wp_send_json(array(
            'success' => false,
            'message' => 'Invalid data received.',
        ));
    }
}

function delete_email_address() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'chatbot_send_lead_alert'; // Replace with your table name
    $email_column = 'email_address'; // Adjust this to your actual column name

    if (isset($_GET['email'])) {
        $email = sanitize_email($_GET['email']);

        // Delete the email address from the database
        $result = $wpdb->delete(
            $table_name,
            array($email_column => $email),
            array('%s')
        );

        if ($result === false) {
            wp_send_json(array(
                'success' => false,
                'message' => 'Error deleting email address: ' . $wpdb->last_error,
            ));
        } else {
            wp_send_json(array(
                'success' => true,
                'message' => 'Email address deleted successfully.',
            ));
        }
    } else {
        wp_send_json(array(
            'success' => false,
            'message' => 'Invalid data received.',
        ));
    }
}


// Add the WordPress AJAX actions for updating and deleting email addresses
add_action('wp_ajax_update_email_address', 'update_email_address');
add_action('wp_ajax_delete_email_address', 'delete_email_address');
add_action('wp_ajax_nopriv_update_email_address', 'update_email_address');
add_action('wp_ajax_nopriv_delete_email_address', 'delete_email_address');






// Callback function to handle the AJAX request
function chatbot_display_optional_test() {
  

    if ($_GET['fieldName'] === 'name') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('name_field_status', $value);
        
        if ($value === '1') {
            echo json_encode(['message' => 'name is required']);
        } else {
            echo json_encode(['message' => 'name is optional']);
        }
    }


    if ($_GET['fieldName'] === 'email') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('selected required email', $value);
        
        if ($value === '1') {
            echo json_encode(['message' => 'Email is required']);
        } else {
            echo json_encode(['message' => 'Email is optional']);
        }
    }


    if ($_GET['fieldName'] === 'phone') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('phone_field_status', $value);
        
        if ($value === '1') {
            echo json_encode(['message' => 'phone is required']);
        } else {
            echo json_encode(['message' => 'phone is optional']);
        }
    }

    if ($_GET['fieldName'] === 'company') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('company_field_status', $value);
        
        if ($value === '1') {
            echo json_encode(['message' => 'company is required']);
        } else {
            echo json_encode(['message' => 'company is optional']);
        }
    }

    if ($_GET['fieldName'] === 'job_titles') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('job_titles_field_status', $value);
        
        if ($value === '1') {
            echo json_encode(['message' => 'job_titles is required']);
        } else {
            echo json_encode(['message' => 'job_titles is optional']);
        }
    }

    if ($_GET['fieldName'] === 'address') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('address_field_status', $value);
        
        if ($value === '1') {
            echo json_encode(['message' => 'address is required']);
        } else {
            echo json_encode(['message' => 'address is optional']);
        }
    }

    if ($_GET['fieldName'] === 'birth_date') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('birth_date_field_status', $value);
        
        if ($value === '1') {
            echo json_encode(['message' => 'birth_date is required']);
        } else {
            echo json_encode(['message' => 'birth_date is optional']);
        }
    }

    if ($_GET['fieldName'] === 'gender') {
        $value = $_GET['value']; // Get the value (1 or 0) from Axios
        // Add your database or storage logic here to save the value for the "email" field
        // Example: Update a database record or save it to a file
        // For demonstration purposes, we'll just return a success message
        update_option('gender_field_status', $value);
        
        if ($value === '1') {
            echo json_encode(['message' => 'gender is required']);
        } else {
            echo json_encode(['message' => 'gender is optional']);
        }
    }

   





    // $field_name = sanitize_text_field($_GET['fieldName']);
    // $field_value = sanitize_text_field($_GET['value']);

    // // Perform your logic based on the field name and value
    // if ($field_name === 'name' ) {
    //     // Example: Update the 'name' field status in your database
    //     // Replace this with your actual database update logic
    //     update_option('name_field_status', $field_value);
    // }

    // // Send a response (optional)
    // wp_send_json_success(array('message' => 'Field status updated successfully'));

    // Always exit to prevent extra output
    wp_die();
}


// Define an action hook to handle the AJAX request
add_action('wp_ajax_chatbot_display_optional_test', 'chatbot_display_optional_test');
add_action('wp_ajax_nopriv_chatbot_display_optional_test', 'chatbot_display_optional_test');