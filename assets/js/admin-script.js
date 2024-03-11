jQuery(document).ready(function($) {
    // Real-time filtering based on search input
    $('#chatbot-search-input').on('input', function() {
        var searchValue = $(this).val().trim().toLowerCase();
        if (searchValue !== '') {
            console.log('search', searchValue);
        }
        filterUsers(searchValue);
    });

    // Function to filter users based on search input
    function filterUsers(searchValue) {
        $('#chatbot-users-table tr:not(:first-child)').filter(function() {
            var userName = $(this).find('.user-name').text().toLowerCase();
            var userEmail = $(this).find('.user-email').text().toLowerCase();
            var userPhone = $(this).find('.user-phone').text().toLowerCase();
            var showRow = userName.indexOf(searchValue) > -1 || userEmail.indexOf(searchValue) > -1 || userPhone.indexOf(searchValue) > -1;
            $(this).toggle(showRow);
        });

        // Show "Users not found" message if no rows are visible
        var visibleRows = $('#chatbot-users-table tr:not(:first-child):visible');
        if (visibleRows.length === 0) {
            $('#users-not-found-message').show();
        } else {
            $('#users-not-found-message').hide();
        }
    }

    // Prevent the default form submission and handle the search request using AJAX
    $('#chatbot-search-form').on('submit', function(e) {
        e.preventDefault();
        const searchQuery = $('#chatbot-search-input').val();
        if (searchQuery !== '') {
            ajaxFilterUsers(searchQuery);
        }
    });

    // AJAX function to search users
    function ajaxFilterUsers(searchQuery) {
        // console.log('ajax url', ajax_object.ajax_url);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'chatbot_search_users', // AJAX action to handle the search request
                search_query: searchQuery,
            },
            success: function(response) {
                if (response.success) {
                    // Update the table with the AJAX response
                    $('#chatbot-users-table tbody').html(response.data);
                    // Hide "Users not found" message if data is found
                    $('#users-not-found-message').hide();
                } else {
                    // Handle the error or display a message
                    console.error(response.data);
                    // Show "Users not found" message if no data is found
                    $('#users-not-found-message').show();
                }
            },
            error: function(error) {
                console.error('Error searching users:', error);
                // Show "Users not found" message on error
                $('#users-not-found-message').show();
            },
        });
    }

    // Call the AJAX function when needed (you can call it initially to show all users)
    // ajaxFilterUsers('');

});


//Menu Section Image upload 
// jQuery(document).ready(function($) {
//     console.log('Image Upload section for menu');
//     $('#upload-menu-image').on('click', function() {
//         if (wp.media.frames.menu_image) {
//             wp.media.frames.menu_image.open();
//             return;
//         }

//         wp.media.frames.menu_image = wp.media({
//             title: 'Choose Image',
//             button: {
//                 text: 'Select'
//             },
//             multiple: false
//         });

//         wp.media.frames.menu_image.on('select', function() {
//             var attachment = wp.media.frames.menu_image.state().get('selection').first().toJSON();
//             $('#menu-image').val(attachment.url);
//         });

//         wp.media.frames.menu_image.open();
//     });
// });

jQuery(document).ready(function($) {
    $('#menu-image').on('change', function() {
        var file = this.files[0];
        if (file) {
            if(file.type.startsWith('image/') && !file.type.endsWith('webp')&& !file.type.endsWith('svg+xml')&& !file.type.endsWith('gif')&& !file.type.endsWith('csv')&& !file.type.endsWith('pdf')){
            var reader = new FileReader();
            reader.onload = function(e) {
               
                if(e.target.result){
                $('#uploaded-image').attr('src', e.target.result);
                $('#uploaded-image').css("display","block")
                $('#upload-menu-image').show();
            }
            };
            reader.readAsDataURL(file);
        }
    }
    else{
        alert("This file type is not supported.");
    }
    });

    $('#menu-image-preview').on('click', function() {
        $('#menu-image').trigger('click');
    });
});



document.addEventListener('DOMContentLoaded', function() {
    const userLinks = document.querySelectorAll('.user a');
    const chatModal = document.getElementById('chatModal');
    const closeChatModal = document.getElementById('closeChatModal');
    const chatContainerModal = document.getElementById('chatContainerModal');

    userLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
console.log(userId);
            const userId = this.getAttribute('data-user-id');
            openChatModal(userId);
        });
    });

    closeChatModal.addEventListener('click', function() {
        closeChatModal();
    });

    function openChatModal(userId) {
        fetchChatHistory(userId);
        chatModal.style.display = 'block';
    }

    function closeChatModal() {
        chatModal.style.display = 'none';
    }

    function fetchChatHistory(userId) {
        // Perform AJAX request and populate chatContainerModal
        // Example:
        // chatContainerModal.innerHTML = '<div class="message">...</div>';
    }
});
