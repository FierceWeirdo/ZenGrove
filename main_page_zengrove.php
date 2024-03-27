<!DOCTYPE html>

<?php
if (!isset ($_SESSION['UserId'])) {
    include ("welcome_page_zengrove.php");
    exit();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My ZenMates | ZenGrove</title>
    <link rel="stylesheet" href="styling_zengrove.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <style>
        .navbar a,
        #goalNavBar {
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

        #progressTitle {
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

        #mainDiv {
            width: 100%;
        }

        #wonAMedal {
            position: absolute;
            display: none;
            top: 10px;
            right: 10px;
            background-color: #32696D;
            color: #99C2C5;
            border-radius: 20px;
            width: max-content;
            padding: 20px;
            transition: display 0.5s ease;
        }

        #crossBackground {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 30px;
            height: 30px;
            background-color: #99C2C5;
            border: 1px solid #32696D;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        #crossBackground:hover {
            background-color: #99C2C5;
        }

        #crossBackground p {
            margin: 0;
            color: #fff;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div class="navbar navbar-expand-lg">
            <img src='ZenGroveLogo.png' id='zenGroveLogo' width="200px">
            <a class="navbar-brand header-button" data-page="ShowHomePage">Home</a>
            <a class="navbar-brand header-button" data-page="ShowMyZenMates">My ZenMates</a>
            <a class="navbar-brand header-button" data-page="ShowMyProfile">My Profile</a>
            <div class="ml-auto" id='goalNavBar'>
                <p id='progressTitle'>My Daily Progress</p>
                <div class="progress">
                    <div class="progress-bar">??%</div>
                </div>
            </div>
        </div>
        <div id="wonAMedal">
            <h5> Congratulations <img src='ZenMedal.png' width='30px'> </h5>
            <p style="font-size: 15px;"> You reached your goal! You get a ZenMedal! </p>
            <div id='crossBackground'>
                <p> x </p>
            </div>
        </div>
    </header>
    <script>
        $(document).ready(function () {
            var postQuery = {
                Page: 'Default',
                Command: 'ShowHomePage'
            };
            $.post('controller_zengrove.php', postQuery, function (response) {
                $('#mainDiv').html(response);
            });

            var postQuery = {
                Page: 'MainPage',
                Command: 'GetDailyProgress'
            };

            $.post('controller_zengrove.php', postQuery, function (response) {
                $('.progress-bar').css('width', response);
                $('.progress-bar').html(response + '%');

                if ($('.progress-bar').html() == '100%') {
                    $('.progress-bar').css('background-color', '#355938');
                    $('.progress-bar').css('color', '#eee');
                    $('#wonAMedal').css('right', '10px');
                }
            });

        });
        function handleButtonClick(page) {
            if (!page) {
                var page = $(this).attr('data-page');
            }
            var postQuery = {
                Page: 'Default',
                Command: page
            };
            $.post('controller_zengrove.php', postQuery, function (response) {
                $('#mainDiv').html(response);
            });
        }
        $('.header-button').click(function () {
            handleButtonClick.call(this);
        });

    </script>

    <div id="mainDiv">

    </div>
    <form action='controller_zengrove.php' method='POST' id='logOutForm'>
        <input type='hidden' name='Page' value='MainPage'>
        <input type='hidden' name='Command' value='LogOut'>
    </form>
    <script>
        function initializeSessionTimeout() {
            let timer;

            function resetTimer() {
                clearTimeout(timer);
                timer = setTimeout(logoutUser, 60 * 1000);
            }

            function logoutUser() {
                $('#logOutForm').submit();
            }

            resetTimer();

            window.addEventListener("mousemove", resetTimer);
        }

        initializeSessionTimeout();
    </script>
</body>

</html>