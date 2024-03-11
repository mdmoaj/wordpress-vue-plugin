// console.log('session ID NEW', sessionIdNew);


// Will output the session ID

// selectedOption
// console.log('first response', selectedOption);

// console.log('type of format', typeof (selectedOptiontwo));

var selectedOptiontwo = selectedOptiontwo; // Replace '123' with your actual string value
var integerNumber = parseInt(selectedOptiontwo, 10); // The second argument '10' specifies base 10 for decimal numbers

console.log("type of format", typeof integerNumber);

// Function to scroll to the bottom of the chat container
function scrollToBottom() {
  var chatContainer = document.getElementById("chatbot-messages");
  chatContainer.scrollTop = chatContainer.scrollHeight;
}

// Auto-scroll when new content is added
function autoScroll() {
  var chatContainer = document.getElementById("chatbot-messages");
  var messages = document.getElementById("chatbot-messagesSend");
  messages.addEventListener("DOMNodeInserted", function (event) {
    if (event.target && chatContainer) {
      scrollToBottom();
    }
  });
}

// Call autoScroll when the page loads
window.addEventListener("load", function () {
  autoScroll();
});

// Call autoScroll when a new message is added
function addMessage(message) {
  var messages = document.getElementById("chatbot-messagesSend");
  messages.insertAdjacentHTML("beforeend", message);
  scrollToBottom();
}

document.addEventListener("DOMContentLoaded", function () {
  const getStartedButton = document.getElementById("getStartedButton");
  const aiOverLayout = document.querySelector(".ai_over_layout");

  getStartedButton.addEventListener("click", function () {
    aiOverLayout.style.display = "none"; // Hide the ai_over_layout element
  });
});
console.log("Script loaded and executed successfully!");
jQuery(document).ready(function ($) {
  //New Chatbot Design

  var responseCounter = 0; // Counter for tracking responses
  var enableFormSubmission = false;

  function sendUserInput(input, name, email, phone) {
    console.log("session ID NEW", sessionIdNew);
    sessionStorage.setItem("sessionId", sessionIdNew);

    var sessionId = sessionStorage.getItem("sessionId");

    console.log("session Storage", sessionId);






    
  

    // var ProfilePicture = imageUrl;

    var userName = $("#name").val();
    var userEmail = $("#email").val();
    var userPhone = $("#phone").val();
    var userCompany = $("#company").val();
    var userJob = $("#job").val();
    var userAddress = $("#address").val();
    var userDob = $("#dob").val();
    var userGender = $("#gender").val();

    // console.log('Session ID', session_id);
    // console.log('Inside the function', responseCounter);
    // console.log('selectedOptionData.selectedOption:', selectedOptionData.selectedOption);
    const Counter = Number(selectedOptionData.selectedOption);
    console.log("selected data counter", Counter);

    // console.log('type of format', typeof (Counter));
    // console.log('Counter Response: ' + Counter);

    $.ajax({
      url: ajax_object.ajax_url,
      method: "POST",
      data: {
        action: "chatbot_send_input",

        user_message: input,
        name: userName,
        email: userEmail,
        phone: userPhone,
        company: userCompany,
        job: userJob,
        address: userAddress,
        dob: userDob,
        gender: userGender,
        sessionId: sessionId,
        // session: session_id,
        api_url: ajax_object.api_url,
        api_token: ajax_object.api_token,
      },
      success: function (response) {
        try {
          const dataStart = response.data.indexOf('{"response":');
          const dataEnd = response.data.indexOf("}", dataStart) + 1;
          const responseData = response.data.substring(dataStart, dataEnd);

          const parsedData = JSON.parse(responseData);
          const botResponse = parsedData.response;
          console.log("data", parsedData);
          const errorMessage = parsedData.data;
          console.log("errorMessage".errorMessage);

          // Extract and handle the error message properly
          const errorHtml = parsedData.data;
          const errorContainer = document.createElement("div");
          errorContainer.innerHTML = errorHtml;

          responseCounter++;
          console.log("response casda", responseCounter);

          if (responseCounter === 4 || responseCounter === 6) {
            $("#chatbot-messages").addClass("active");
            $("#chatbot-form").show();
            $("#form-confirmation").show();
            // $('#chatbot-input').off('keypress');
            // enableFormSubmission = true;
          }

          if (botResponse) {
            displayChatbotResponse(botResponse);
          } else {
            if (responseCounter === Counter && !enableFormSubmission) {
              displayChatbotResponseWithTypingAnimation(
                "Filling the form for a better experience."
              );
              responseCounter++;
            } else {
              if (errorMessage) {
                displayChatbotResponse(errorMessage);
              } else {
                // displayChatbotResponse("An error occurred.");
              }
              responseCounter++;
            }

            // Handle any additional successful response logic here
            console.log("response counter", responseCounter);

            if (responseCounter === 4 && !enableFormSubmission) {
              $("#chatbot-messages").addClass("active");
              $("#chatbot-form").show();
              $("#form-confirmation").show();
              // $('#chatbot-input').off('keypress');
              enableFormSubmission = true;
            }
          }

          hideBlinkingAnimation();
        } catch (error) {
          // console.error("Error occurred:", error);
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
    console.log("Profile Picture Latest: ", imageUrl);

    let myVariable = imageUrl;
  return myVariable;

    // Other code ...
  }

  function saveChatHistoryToLocalStorage(sessionId, chatHistory) {
    // Convert chat history to JSON format
    const chatHistoryJSON = JSON.stringify(chatHistory);

    // Save the chat history to local storage
    localStorage.setItem(sessionId, chatHistoryJSON);
    console.log("chat history", chatHistoryJSON);
  }

  function hideTypingAnimation() {
    $(".ticontainer").remove();
  }

  function hideBlinkingAnimation() {
    $(".ticontainer").remove();
  }

  var isFormSubmitted = false;
  // Function to enable enter key functionality for chatbot input
  function enableEnterKeyForChatbotInput() {
    $("#chatbot-input").on("keypress", function (event) {
      if (event.which === 13 && isFormSubmitted) {
        var userInput = $(this).val().trim();
        if (userInput !== "") {
          $(this).val("");
          displayUserInputWithTypingAnimation(userInput);
          displayChatbotResponseWithBlinkingAnimation();
          sendUserInput(userInput);
        }
      }
    });
  }
  // Function to handle form submission
  function handleFormSubmission(input) {
    $("#chatbot-form").submit(function (event) {
      event.preventDefault();
      var userInput = $("#chatbot-input").val().trim();

      if (userInput !== "") {
        $("#chatbot-input").val("");
        displayUserInputWithTypingAnimation(userInput);
        displayChatbotResponseWithBlinkingAnimation();
        sendUserInput(userInput);
        apiResponseCount = 0; // Reset API response count

        $("#chatbot-form").hide();
        $("#form-confirmation").hide();

        // $('#chatbot-messages').removeClass('active');
        $("#chatbot-search-input").show();
        isFormSubmitted = true; // Set form submitted to true
        enableEnterKeyForChatbotInput(); // Enable enter key for chatbot input
      }
    });
  }

  // Call the function to handle form submission
  handleFormSubmission();

  // Display user input in a div with typing animation
  function displayUserInputWithTypingAnimation(input) {
    var $userInputContainer = $(
      '<div class="my-3w">' +
        '<div class="d-flex align-items-center justify-content-end ms-3">' +
        "</div>" +
        "</div>"
    );

    var $userInput = $('<div class="mb-0 response_p"></div>').text(input);
    $userInputContainer.append($userInput);
    $("#chatbot-messages").append($userInputContainer);

    // Trigger the typing animation
    $userInput.addClass("user-input");
    var userInputText = $userInput.text();
    $userInput.empty();
    $userInput.append("<span></span>");

    var typingSpan = $userInput.find("span");
    typingSpan.text(userInputText);
    typingSpan.css(
      "animation",
      "typing 1s steps(" + userInputText.length + ") infinite"
    );
    // $chatbotMessages.scrollTop($chatbotMessages.prop('scrollHeight'));
  }

  // Display chatbot response with typing animation
  function displayChatbotResponseWithTypingAnimation(response, imageUrl) {
    let receivedVariable = sendUserInput();
  console.log("Profile Photo Send" . receivedVariable);
   
    var $chatbotResponseContainer = $(
      '<div ><img src="' +
      receivedVariable +
        '" class="send_ai_icon" alt="Profile Picture"/><div class="chatbot-response-container"></div></div>'
    );
    var $chatbotResponse = $('<div class="chatbot-response"></div>').text(
      response
    );
    $chatbotResponseContainer.append($chatbotResponse);
    $("#chatbot-messages").append($chatbotResponseContainer);

    // Trigger the typing animation
    $chatbotResponse.addClass("chatbot-response");
    var chatbotResponseText = $chatbotResponse.text();

    $chatbotResponse.empty();
    $chatbotResponse.append("<span></span>");

    var typingSpan = $chatbotResponse.find("span");
    typingSpan.text(chatbotResponseText);

    typingSpan.css(
      "animation",
      "typing 1s steps(" + chatbotResponseText.length + ") infinite"
    );
  }

  // displayChatbotResponseWithTypingAnimation(responseText, imageUrl);
  // Display user input in a div
  // function displayUserInput(input) {
  //     var $chatbotMessages = $('#chatbot-messages');
  //     var $userInputContainer = $('<div class="user-input-container"></div>');
  //     var $userInput = $('<div class="user-input"></div>').text(input);
  //     $userInputContainer.append($userInput);

  //     $chatbotMessages.append($userInputContainer);

  // }

  // Display chatbot response with blinking animation
  function displayChatbotResponseWithBlinkingAnimation() {
    var $chatbotResponseContainer = $(
      '<div class="chatbot-response-container"></div>'
    );
    var $chatbotResponse = $('<div class="chatbot-response"></div>');
    $chatbotResponseContainer.append($chatbotResponse);
    $("#chatbot-messages").append($chatbotResponseContainer);

    // Trigger the blinking animation
    $chatbotResponse.addClass("ticontainer");

    $chatbotResponse.append(
      '<div class="tiblock"><div class="tidot"></div>  <div class="tidot"></div>  <div class="tidot"></div> </div>'
    );
  }

  // Display chatbot response with typing animation
  // Display chatbot response with typing animation
  // var imageUrl = "../assets/images/ai_image.png";
  // var userName = $('#chatbot_user').val();

  function displayChatbotResponse(response) {
    var $chatbotMessages = $("#chatbot-messages");
    // var $chatbotResponseContainer = $('<div class="response-js">' +
    //     '<p class="mb-0 ms-2 ms-sm-3">' + userName + '</p>' +
    //     '<img src="' + imageUrl + '" class="img-fluid rounded-top mb-3" alt="Profile Picture"/>' +
    //     '<div class="chatbot-response-container"></div>' +
    //     '</div>');

    var $chatbotResponseContainer = $(
      "<div>" +
        '<div class="d-flex justify-content-start">' +
        '<div class="send_ai_icon">' +
        '<img src="' +
        imageUrl +
        '" class="" alt="">' +
        "</div>" +
        '<div class="ms-3">' +
        '<h5 class="send_h5">' +
        userName +
        "</h5>" +
        // '<p class="mb-0 ms-2 send_p">' + userName + '</p>' +
        "</div>" +
        "</div>" +
        '<div class="my-3">' +
        '<div class="d-flex align-items-center justify-content-end ms-3">' +
        '<p class="mb-0  chatbot-response-container">' +
        "</p>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    var $chatbotResponse = $('<div class="chatbot-response"></div>');
    $chatbotResponseContainer.append($chatbotResponse);
    $chatbotMessages.append($chatbotResponseContainer);
    $chatbotMessages.scrollTop($chatbotMessages.prop("scrollHeight"));

    // Function to simulate typing effect for each character
    function typeCharacter(index) {
      if (index < response.length) {
        $chatbotResponse.text(response.substring(0, index + 1));
        setTimeout(function () {
          typeCharacter(index + 1);
        }, 1); // Adjust the typing speed as needed (in milliseconds)
      } else {
        $chatbotMessages.scrollTop($chatbotMessages.prop("scrollHeight")); // Scroll to bottom of chat container after typing complete
        $(".chatbot-ticontainer").addClass("show"); // Hide the typing dots after typing complete
      }
    }

    // Start the typing animation for the response
    typeCharacter(0);
    // Scroll to the bottom of chat container after displaying the response
    $chatbotMessages.scrollTop($chatbotMessages.prop("scrollHeight"));
  }

  // Handle user input
  // $('#chatbot-input').keypress(function(event) {
  //     if (event.which === 13) {
  //         var userInput = $(this).val().trim();
  //         if (userInput !== '') {
  //             $(this).val('');
  //             displayUserInputWithTypingAnimation(userInput);
  //             displayChatbotResponseWithBlinkingAnimation();
  //             sendUserInput(userInput);

  //         }
  //     }
  // });

  // $('#chatbot-input').keypress(function(event) {
  //     if (event.which === 13) {
  //         var userInput = $(this).val().trim();
  //         if (userInput !== '') {
  //             $(this).val('');
  //             displayUserInputWithTypingAnimation(userInput);
  //             displayChatbotResponseWithBlinkingAnimation();
  //             // displayUserInputWithTypingAnimation(userInput);

  //             if (!enableFormSubmission) {
  //                 sendUserInput(userInput);
  //             } else {
  //                 // User input after form submission, process normally
  //                 // ... (your existing code)
  //             }
  //         }
  //     }
  // });

  $("#chatbot-input").keypress(function (event) {
    if (event.which === 13) {
      var userInput = $(this).val().trim();
      if (userInput !== "") {
        $(this).val("");
        displayUserInputWithTypingAnimation(userInput);

        displayChatbotResponseWithBlinkingAnimation();

        if (!enableFormSubmission) {
          sendUserInput(userInput);
        } else {
          // User input after form submission, process normally
          // ... (your existing code)
        }
      }
    }
  });

  $("#send-icon").click(function () {
    // console.log("PRESS");
    simulateUserInput(userInput);
  });

  // $('#send-btn').click(function () {

  //    sendUserInput(userInput);
  // });

  function simulateUserInput(userInput) {
    // Call the function to display user input with typing animation
    displayUserInputWithTypingAnimation(userInput);

    // Simulate sending the user input and receiving a response
    sendUserInput(userInput);
  }

  // Toggle chatbot container when the icon is clicked
  $("#close-icon").click(function () {
    $("#chatbot-container").slideToggle();
  });

  // $('#refresh-icon').click(function() {
  //     clearChatHistory();
  // });

  // function clearChatHistory() {
  //     $('#chatbot-messages').empty(); // Remove all chat messages
  // }

  $("#formCloseButton").click(function () {
    console.log("you tuched me");
  });

  // Handle refresh button click
  $("#refresh-icon").click(function () {
    clearChatHistory();

    displayWelcomeMessage();
    // $('#enableAfterClr').show();
  });

  function clearChatHistory() {
    $("#chatbot-messages").empty(); // Remove all chat messages
    $("#enableAfterClr").hide();
  }

  function displayWelcomeMessage() {
    var $welcomeMessageContainer = $(
      '<div class="chatbot-response-container"></div>'
    );

    var $welcomeMessage = $(
      '<div class="d-flex justify-content-start">' +
        '<div class="send_ai_icon ">' +
        '<img src=" ' +
        imageUrl +
        ' ">' +
        "</div>" +
        '<div class=" ms-3">' +
        '<h5 class="send_h5">' +
        userName +
        "</h5>" +
        '<p class="mb-0 send_p">' +
        welcomeMsg +
        "</p>" +
        "</div>" +
        "</div>"
    );

    $welcomeMessageContainer.append($welcomeMessage);
    $("#chatbot-messages").append($welcomeMessageContainer);
  }

  $("#formCloseButton").click(function () {
    console.log("hide the form");
    $("#chatbot-form").hide();
    $("#form-confirmation").hide();
  });

  // $(document).on('click', '#close-icon', function() {
  //     clearChatHistory();
  //     console.log("refresh");
  // });

  $("#chatbot-icons").click(function () {
    $("#chatbot-container").slideToggle();
  });

  // Show chatbot container after a delay
  // setTimeout(function() {
  //     $('#chatbot-container').show();
  // }, 5000); // Adjust the delay (in milliseconds) as needed

  function showLoadingSpinner() {
    var $loader = $('<div class="loader"></div>');
    $("#submit-btn").append($loader); // Append the loader to the submit button
  }

  // Remove loading spinner
  function hideLoadingSpinner() {
    $(".loader").remove();
  }

  // Handle form submission

  // $(document).ready(function() {
  //     $('#chatbot-search-input').hide();
  // });

  // $(document).ready(function() {
  //     $('#chatbot-form').hide();
  // });

  $("#chatbot-form").submit(function (event) {
    event.preventDefault();
    var $submitButton = $("#submit-btn");
    var name = $("#name").val().trim();
    var email = $("#email").val().trim();
    var phone = $("#phone").val().trim();
    var company = $("#company").val().trim();
    var userJob = $("#job").val();
    var userAddress = $("#address").val();
    var userDob = $("#dob").val();
    var userGender = $("#gender").val();

    sendUserInput("", name, email, phone);
    // displayChatbotResponseWithBlinkingAnimation();

    $("#chatbot-input").on("keypress", function (event) {
      if (event.which === 13) {
        var userInput = $(this).val().trim();
        if (userInput !== "") {
          $(this).val("");
          displayUserInputWithTypingAnimation(userInput);

          displayChatbotResponseWithBlinkingAnimation();

          if (!enableFormSubmission) {
            sendUserInput(userInput);
          } else {
            // User input after form submission, process normally
            // ... (your existing code)
          }
        }
      }
    });
    // Show the loading state
    showLoadingSpinner();
    $submitButton.addClass("loading");
    $submitButton.attr("disabled", true);
    enableFormSubmission = false;

    // Send user details to the server

    $.ajax({
      url: ajax_object.ajax_url,
      method: "POST",
      data: {
        action: "chatbot_store_user_details",
        name: name,
        email: email,
        phone: phone,
        company: company,
        job: userJob,
        address: userAddress,
        dob: userDob,
        gender: userGender,
      },
      success: function (response) {
        console.log(response);

        // Hide the loading state
        $("#chatbot-messages").removeClass("active");
        $submitButton.removeClass("loading");
        $submitButton.attr("disabled", false);
        $(".loader").remove(); // Remove the loader from the button

        // Hide the form container and loading spinner
        hideFormContainer();
        chatbotformresponse();

        // Show the chatbot search input
        showChatbotSearchInput(name);
      },
      error: function (xhr, status, error) {
        console.error(error);

        // Hide the loading state
        $submitButton.removeClass("loading");
        $submitButton.attr("disabled", false);
        $(".loader").remove(); // Remove the loader from the button

        // Hide the form container and loading spinner
        hideFormContainer();
        chatbotformresponse();
        // Show the chatbot search input
        showChatbotSearchInput();
        //   $('#chatbot-input').off('keypress');
      },
    });
  });

  // Show the chatbot form container initially
  // Hide the chatbot search input initially
  $(document).ready(function () {
    $("#chatbot-search-input").show();
  });

  function hideFormContainer() {
    $("#chatbot-form").hide();
  }
  function chatbotformresponse() {
    $("#form-confirmation").hide();
  }

  function showAfterClr() {
    $("#enableAfterClr").hide();
  }

  function showChatbotSearchInput(name) {
    $("#chatbot_user").val(name);
    $("#chatbot-search-input").show();
  }
  // Update chatbot-header with user name
  function updateUserName(userName) {
    const userNameContainer = document.getElementById("user-name-container");
    const userNameElement = userNameContainer.querySelector("h3");
    // Try to get user information from cookies
    const storedUserName = getCookie("user_name");
    const storedUserEmail = getCookie("user_email");
    const storedUserPhone = getCookie("user_phone");

    // Use the stored information if available, otherwise use the provided name
    userNameElement.textContent = storedUserName
      ? storedUserName
      : userName
      ? userName
      : "Your Name";
  }

  // Function to handle chatbot-header updates
  function handleChatbotHeader(data) {
    const chatbotHeader = document.getElementById("chatbot-header");
    const chatbotIcon = chatbotHeader.querySelector("#chatbot-icon");

    if (data && data.user_name) {
      // Update user name in the chatbot-header
      updateUserName(data.user_name);
      updateUserName(storedUserName);
      chatbotIcon.style.display = "block"; // Show chatbot icon
    } else {
      chatbotIcon.style.display = "none"; // Hide chatbot icon if user name is not available
    }
  }

  // Load user name and update chatbot-header
  handleChatbotHeader(ajax_object);

  $(document).on("submit", "#chatbot-search-form", function (e) {
    console.log("chatbot-search-form"); // Make sure this log appears in the console
    e.preventDefault();
    const searchQuery = $("#user-search").val();
    if (searchQuery !== "") {
      chatbotSearchUsers(searchQuery);
    }
    // Trigger the form submission for chatbot_users_settings_page()
    $("#chatbot-users-search-form")[0].submit(); // Use [0] to get the DOM element and then call submit()
  });

  // Function to fetch and display conversation history
  function displayConversationHistory() {
    $.ajax({
      url: ajax_object.ajax_url,
      method: "POST",
      data: {
        action: "chatbot_get_conversation_history",
      },
      success: function (response) {
        var responseData = response.data;
        for (var i = 0; i < responseData.length; i++) {
          var conversation = responseData[i];
          displayUserInput(conversation.user_message);
          displayChatbotResponse(conversation.bot_response);
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  }

  // Toggle chatbot container when the icon is clicked
  $("#close-icon").click(function () {
    $("#chatbot-container").slideToggle();
    // Load conversation history when the chatbot container is shown
    if ($("#chatbot-container").is(":visible")) {
      displayConversationHistory();
    }
  });
  $("#chatbot-icons").click(function () {
    $("#chatbot-container").slideToggle();
    // Load conversation history when the chatbot container is shown
    if ($("#chatbot-container").is(":visible")) {
      displayConversationHistory();
    }
  });

  //refresh
  // $(document).on('click', 'refresh-icon', function() {
  //     clearChatHistory();
  //     console.log("refresh");
  // });
  // Function to clear chat history
  // Function to set a cookie

  // $('#formCloseButton').click(function () {
  //     $('#chatbot-form').hide();
  //     // $('#form-confirmation').hide();

  // });
});
