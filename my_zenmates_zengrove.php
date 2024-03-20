<!DOCTYPE html>
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

                /* Handle */
            #chatHistory::-webkit-scrollbar-thumb {
                background: #064348;
                border-radius: 20px;
            }

                /* Handle on hover */
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
                border-top: none !important;
            }
            #friendListTable tr:hover {
                cursor: pointer !important;
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
                                            <tr>
                                              <td>John</td>
                                            </tr>
                                            <tr>
                                              <td>Mary</td>
                                            </tr>
                                            <tr>
                                              <td>July</td>
                                            </tr>
                                            <tr>
                                                <td>John</td>
                                              </tr>
                                              <tr>
                                                <td>Mary</td>
                                              </tr>
                                              <tr>
                                                <td>July</td>
                                              </tr>
                                              <tr>
                                                <td>John</td>
                                              </tr>
                                              <tr>
                                                <td>Mary</td>
                                              </tr>
                                              <tr>
                                                <td>July</td>
                                              </tr>
                                            
                                        </table>
                                        </div>
                                </div>
                                <div id="messageTypingMainDiv" class="row">
                                    <input type="text" id="messageInput" class="col-sm-10">
                                    <div class="col-sm-2">
                                        <div id="sendButton">
                                            Send <img src="SendIcon.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="friendProfileDiv">
                                <p>Entered ZenGrove: </p>
                                <p>Daily Meditation Goal: </p>
                                <p>Total ZenMedals of Achievement: </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                $(document).ready(function(){
                    $('#messageOrProfileButton').html('View Profile');

                    $.ajax({
                        url: 'controller_zengrove.php',
                        type: 'POST',
                        data: {
                            Page: 'MyZenMates',
                            Command: 'GetAllZenMates'
                        },
                        success: function(response ) {
                            $('#friendListTable').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                });
                $('#messageOrProfileButton').click(function(){
                    if($('#messageOrProfileButton').html() == 'View Profile'){
                        $('#messageOrProfileButton').html('Message');
                        $('#messagingDiv').css('display', 'none');
                        $('#friendProfileDiv').css('display', 'block');
                    }
                    else {
                        $('#messageOrProfileButton').html('View Profile');
                        $('#messagingDiv').css('display', 'block');
                        $('#friendProfileDiv').css('display', 'none');
                    }
                });
            </script>
         </div>
    </body>
</html>