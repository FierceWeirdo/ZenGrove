<!DOCTYPE html>
<?php 
if (!isset($_SESSION['UserId'])) {
    // If the user is not logged in, include the welcome page and exit
    include("welcome_page_zengrove.php");
    exit();
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My ZenMates | ZenGrove</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="styling_zengrove.css">
        <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
        <style>
            .progress {
                width: 100px;
                height: 35px;
                background-color: #32696D;
                border-radius: 20px;
                padding: 5px;
                margin-left: auto;
            }

            .progress-bar {
                height: 100%;
                background-color: #99C2C5;
                text-align: center;
                color: #32696D;
                border-radius: 20px;
            }
            #mainBody {
                margin: 0px 80px;
                padding: 30px;
                background-color: #32696D;
                border-radius: 20px;
                height: 75vh;
                color: #99C2C5;
                position: relative;
                font-size: 20px;
            }

            #bodyHeading{
                font-size: 30px;
                text-decoration: underline;
                font-weight: 900;
            }

            #searchBar{
                width: 100%;
                background-color: #99C2C5;
                color: #32696D;
                border-radius: 20px;
                padding: 5px 15px;
                position: relative;
            }

            #searchIcon {
                position: absolute;
                right: 10px;
                top:6px;
                &:hover{
                    cursor: pointer;
                }
            }

            #row2{
                margin-top: 15px;
                height:100%;
            }

            #friendsList{
                width: 100%;
                background-color: #99C2C5;
                color: #32696D;
                border-radius: 20px;
                padding: 5px 15px;
                position: relative;
                height:78%;
                max-height: 50vh;
                overflow: auto;
            }
            
            #friendsList::-webkit-scrollbar {
                width: 10px;
            }

                /* Track */
            #friendsList::-webkit-scrollbar-track {
                background: #99C2C5;
                border-radius: 20px;
                padding: 2px;
            }

                /* Handle */
            #friendsList::-webkit-scrollbar-thumb {
                background: #064348;
                border-radius: 20px;
            }

                /* Handle on hover */
            #friendsList::-webkit-scrollbar-thumb:hover {
                background: #577e81;
                border-radius: 20px;
            }

            #searchUsernameInputBox{
                border: none;
                width: 98%;
                background-color: #99C2C5;
            }

            #searchIcon{
                width: 2%;
                min-width: 25px;
            }

            #mainProfileAndChatDiv{
                width: 100%;
                background-color: #99C2C5;
                color: #32696D;
                border-radius: 20px;    
                padding: 10px;
                height: 91%;
            }

            #headerDiv{
                margin: 0px 2px;
                padding: 5px;
                background-color: #32696D;
                color: #99C2C5;
                border-radius: 20px;
                position: relative;
                font-weight: 900;
            }

            #messageOrProfileButton{
                background-color: #99C2C5;
                color: #293434;
                border-radius: 20px;
                text-align: center;
                padding: 1px 3px;
                &:hover{
                    cursor: pointer;
                    background-color: #064348;
                    color: #99C2C5;
                }
            }

            #messagingDiv{
                height: 100%;
                width: 100%;
            }

            #chatHistory{
                height: 80%;
                overflow-y: auto;
                max-height: 50vh;
            }
            
            #chatHistory::-webkit-scrollbar {
                width: 10px;
            }

            #chatHistory::-webkit-scrollbar-track {
                background: #99C2C5;
                border-radius: 20px;
                padding: 2px;
            }

            #chatHistory::-webkit-scrollbar-thumb {
                background: #064348;
                border-radius: 20px;
            }

            #chatHistory::-webkit-scrollbar-thumb:hover {
                background: #577e81;
                border-radius: 20px;
            }

            #messageTypingMainDiv{
                height: 10%;
                bottom: 0;
            }

            #messageInput{
                padding: 5px 10px;
                background-color: #32696D;
                color: #99C2C5;
                border-radius: 20px;
                font-weight: 900;
                border: none;
            }

            #messageInput::placeholder{
                color: white !important;
                font-weight: 100;
            }

            #sendButton{
                padding: 5px;
                background-color: #99C2C5;
                color: #32696D;
                border-radius: 20px;
                font-weight: 900;
                border: 2px solid #32696D;
                text-align: center;
                &:hover{
                    cursor: pointer;
                    background-color: #064348;
                    color: #99C2C5;
                }
            }

            #friendProfileDiv{
                padding: 20px;
                font-weight: 900;
                display: none;
            }

            #friendListTable {
                width: 100%;
            }

            #friendListTable tr td{
                border-radius: 20px;
                border-top: none !important;
                &:hover{
                    background-color: rgba(26, 33, 43, 0.2);
                }
            }
            
            #friendListTable tr:hover {
                cursor: pointer !important;
            }

            #searchContainer {
                display: none;
                width: 50%;
                height: auto;
                margin: 0.5%;
                padding: 1%;
                color: #32696D;
                background-color: #99C2C5;
                overflow: auto;
                z-index: 3;
                border-radius: 20px;
                position: absolute;
                top: 13%;
                border: 1px solid #32696D;
            }

            .addZenMate {
                color: white;
                background-color: #32696D;
                border: 0.5px solid #32696D;
                border-radius: 20px;
                float: right;
            }

            #searchDropdownTable {
                margin-bottom: 0rem !important;
            }

            #searchDropdownTable tr td{
                border: none !important;
            }

            #searchDropdownTable tr th{
                border: none !important;
            }

            .resultUser {
                float: left;
            }
      
        </style>
    </head>
    <body>
        <div id="mainBody">
            <div class="h-100 container-fuid">
                <div class="row">
                    <div id="searchBar">
                        <form>
                            <input type="hidden" name="Page" value="My_Zenmates">
                            <input type="hidden" name="Command" value="Search_Friends">
                            <input id="searchUsernameInputBox" type="text" name="term" placeholder="Search a new ZenMate with Username">
                            <img src="SearchIcon.png" id="searchIcon">
                        </form>
                    </div>
                    <div id="searchContainer">     
                        <table class="table table-fluid" id="searchDropdownTable">
                        </table>
                    </div>
                    <script>
                        $(document).ready(function(){
                            var searchTerm;
                            $('#row2').click(function(){
                                $('#searchContainer').css('display','none');
                                $('#row2').css('filter', 'blur(0px)');
                            });
                            $('#searchIcon').click(function() {
                                searchTerm = $('#searchUsernameInputBox').val();
                                $('#searchContainer').css('display','block');
                                $('#row2').css('filter', 'blur(5px)');
                                $.ajax({
                                    url: 'controller_zengrove.php',
                                    type: 'POST',
                                    data: {
                                        Page: 'MyZenMates',
                                        Command: 'SearchUsers',
                                        Term: searchTerm
                                    },
                                    success: function(response ) {
                                        $('#searchDropdownTable').html(response);
                                        $('.addZenMate').click(function() {
                                            var username = $(this).data('username');
                                            $.ajax({
                                                url: 'controller_zengrove.php',
                                                type: 'POST',
                                                data: {
                                                    Page: 'MyZenMates',
                                                    Command: 'AddZenMate',
                                                    SearchTerm: username
                                                },
                                                success: function(response) {
                                                    $('#searchContainer').css('display','none');
                                                    $('#row2').css('filter', 'blur(0px)');
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('Error fetching data:', error);
                                                }
                                            });
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error fetching data:', error);
                                    }
                                });
                            });
                        });              
                    </script>
                </div>
                <div class="row" id="row2">
                    <div class="col-sm-3">
                        <p id="bodyHeading">My ZenMates</p>
                        <div id="friendsList">
                            <div class="container-fluid">          
                                <table class="table table-hover" id="friendListTable">
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div id="mainProfileAndChatDiv" class="container">
                            <div id="headerDiv" class="row">
                                <div id="usernameHeader" class="col-sm-10">
                                    Username
                                </div>
                                <div id="messageOrProfileButton" class="col-sm-2">
                                    View Profile
                                </div>
                            </div>
                            <div id="messagingDiv" class="container">
                                <div id="chatHistory" class="col-sm-12">
                                    <div class="container-fluid">          
                                        <table class="table table-hover" id="friendMessagingList">

                                        </table>
                                        </div>
                                </div>
                                <div id="messageTypingMainDiv" class="row">
                                    <input type="text" id="messageInput" placeholder="Enter a message" class="col-sm-10">
                                    <div class="col-sm-2">
                                        <div id="sendButton">
                                            Send <img src="SendIcon.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="friendProfileDiv">
                                <p>Entered ZenGrove:  <span id="enterDate"></span> </p>
                                <p>Daily Meditation Goal:  <span id="dailyGoal"></span> </p>
                                <p>Total ZenMedals of Achievement: <span id="zenMedals"></span> <img src="ZenMedal.png" width=20px> </p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                
                $(document).ready(function(){
                    $('#messageOrProfileButton').html('View Profile');

                    $('#sendButton').click(function() {
                        if ($.trim($('#messageInput').val()) !== ''){
                            $.ajax({
                            url: 'controller_zengrove.php',
                            type: 'POST',
                            data: {
                                Page: 'MyZenMates',
                                Command: 'SendMessage',
                                Username: $('#usernameHeader').text(),
                                Message: $.trim($('#messageInput').val())
                            },
                            success: function(response ) {
                                $('#friendMessagingList').html(response);
                                $('#messageInput').val('');
                                
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                        }
                    });
                    

                    function checkUserMessages(){
                        if ($.trim($('#usernameHeader').text()) !== ''){
                            $.ajax({
                                url: 'controller_zengrove.php',
                                type: 'POST',
                                data: {
                                    Page: 'MyZenMates',
                                    Command: 'GetMessagesWithUser',
                                    Username: $('#usernameHeader').html()
                                },
                                success: function(response) {
                                    $('#friendMessagingList').html(response);   
                                    // var chatHistory = document.getElementById("chatHistory");
                                    // chatHistory.scrollTop = chatHistory.scrollHeight;                             
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error fetching data:', error);
                                }
                            });
                        }
                    }

                    $.ajax({
                            url: 'controller_zengrove.php',
                            type: 'POST',
                            data: {
                                Page: 'MyZenMates',
                                Command: 'GetAllZenMates'
                            },
                            success: function(response ) {
                                $('#friendListTable').html(response);
                                $('#usernameHeader').html($('#friendsList tr:first-of-type').text());
                                checkUserMessages();
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching data:', error);
                            }
                        });            

                    checkuserFriends();
                    setInterval(checkuserFriends, 1000);

                    function checkuserFriends(){
                        $.ajax({
                            url: 'controller_zengrove.php',
                            type: 'POST',
                            data: {
                                Page: 'MyZenMates',
                                Command: 'GetAllZenMates'
                            },
                            success: function(response ) {
                                $('#friendListTable').html(response);
                                checkUserMessages();
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                    }                    
                });

                
                $('#messageOrProfileButton').click(function(){
                    if($('#messageOrProfileButton').html() == 'View Profile'){
                        $('#messageOrProfileButton').html('Message');
                        $('#messagingDiv').css('display', 'none');
                        $('#friendProfileDiv').css('display', 'block');
                        getUserInformation();
                    }
                    else {
                        $('#messageOrProfileButton').html('View Profile');
                        $('#messagingDiv').css('display', 'block');
                        $('#friendProfileDiv').css('display', 'none');
                    }
                });

                $(document).on('click', '#friendsList tr td', function() {
                    $('#usernameHeader').html($(this).text());
                    getUserInformation();

                    $.ajax({
                        url: 'controller_zengrove.php',
                        type: 'POST',
                        data: {
                            Page: 'MyZenMates',
                            Command: 'GetMessagesWithUser',
                            Username: $('#usernameHeader').html()
                        },
                        success: function(response ) {
                            $('#friendMessagingList').html(response);                                
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                });

                function getUserInformation(){
                    $.ajax({
                        url: 'controller_zengrove.php',
                        type: 'POST',
                        data: {
                            Page: 'MyZenMates',
                            Command: 'GetUserProfile',
                            Username: $('#usernameHeader').text()
                        },
                        success: function(response ) {
                            var data = JSON.parse(response);
                            $('#enterDate').html(formatDate(data.enterDate));
                            $('#dailyGoal').html(data.dailyGoal + ' minutes');
                            $('#zenMedals').html(data.zenMedals);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
            </script>

            <script>
                function formatDate(inputDate) {
                const year = inputDate.substring(0, 4);
                const month = inputDate.substring(4, 6);
                const day = inputDate.substring(6, 8);
                const formattedDate = new Date(`${year}-${month}-${day}`);
                const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                const monthName = months[formattedDate.getMonth()];
                const output = `${day} ${monthName} ${year}`;

                return output;
            }
    </script>
         </div>
    </body>
</html>