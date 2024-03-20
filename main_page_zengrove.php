<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My ZenMates | ZenGrove</title>
        <link rel="stylesheet" href="styling_zengrove.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
        <style>
            .navbar a, #goalNavBar {
                padding: 0 30px;
                font-size: 24px;
                color: #32696D !important;
            }

            .navbar #goalNavBar {
                font-size: 24px !important;
                color: #32696D !important;
                display: flex !important;
                align-items: center; 
            }

            .navbar a:hover {
                text-decoration: underline;
                font-weight: 900;
                cursor: pointer;
            }
            
            #progressTitle{
                padding: 10px 10px;
                margin: 0;
            }

            .progress {
                width: 100px !important;
                height: 3 5px;
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

            #mainDiv{
                width: 100%;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="navbar navbar-expand-lg">
                <img src='ZenGroveLogo.png' id='zenGroveLogo' width="200px">
                <a class="navbar-brand header-button" data-page="ShowHomePage">Home</a>
                <a class="navbar-brand header-button" data-page="ShowMyZenMates">My ZenMates</a>
                <a class="navbar-brand header-button"  data-page="ShowMyProfile">My Profile</a>
                <div class="ml-auto" id='goalNavBar'>
                    <p id='progressTitle'>My Daily Progress</p>
                    <div class="progress"> 
                        <div class="progress-bar">??%</div>
                    </div>
                </div>
            </div>
        </header>
        <script>
            $(document).ready(function() {
                var postQuery = {
                    Page: 'Default',
                    Command: 'ShowHomePage'
                };
                $.post('controller_zengrove.php', postQuery, function(response) {
                    $('#mainDiv').html(response);
                });

                var postQuery = {
                    Page: 'MainPage',
                    Command: 'GetDailyProgress'
                };

                $.post('controller_zengrove.php', postQuery, function(response) {
                    $('.progress-bar').css('width', response);
                    $('.progress-bar').html(response + '%');
                });

            });
            function handleButtonClick(page) {
                if(!page){
                    var page = $(this).attr('data-page');
                }
                var postQuery = {
                    Page: 'Default',
                    Command: page
                };
                $.post('controller_zengrove.php', postQuery, function(response) {
                    $('#mainDiv').html(response);
                });
            }
            $('.header-button').click(function() {
                handleButtonClick.call(this);
            });

            
        </script>
        <div id="mainDiv">

        </div>
    </body>
</html>