<html>

<?php 
if (!isset($_SESSION['UserId'])) {
    // If the user is not logged in, include the welcome page and exit
    include("welcome_page_zengrove.php");
    exit();
}
?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

            body {
                background-color: #99C2C5;
                font-family: 'Quicksand';
                color: #32696D;
            }
            .row {
                margin: 50px;
                padding: 5px;
                width: 85%;
            }
            .zenko {
                max-width: 100%; 
                max-height: 100%; 
            }
            .circle {
                width: 340px;
                height: 340px;
                max-width: 100%; 
                max-height: 100%; 
                border-radius: 50%;
                background-color: #32696D; 
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .circle:hover {
                box-shadow: 0 0 10px #064348;
                cursor: pointer;    
            }
            .soundButton {
                background-color: #32696D;
                border-radius: 20%;
            }
            .soundButton:hover {
                box-shadow: 3px 3px 5px #064348;
                cursor: pointer; 
            }
            .buttonSound {
                font-size: 18px;
                color: white;
                padding: 8px 5px;
            }
            .speakerButton{
                background-color: white; 
                border-radius: 50%;
                width: 30px;
                height: 30px;
                padding: 6px;
                margin-left: 20px;
                visibility: hidden;
            }
            #centerDiv {
                margin-left: auto;
                margin-right: auto;
            }
            #bottomDiv {
                width: 45vw;
                margin-left: auto;
                margin-right: auto;
            }
            #text {
                font-size: 18px; 
                max-width: 100%; 
                max-height: 100%; 
                padding: 3px;
                text-align: justify;
            }
            #headerText {
                font-size: 18px; 
                max-width: 100%; 
                max-height: 100%;
                background-color: white; 
                border: 0.8px solid #064348;
                padding: 5px;
                margin-top: auto;
                border-radius: 10px;
                text-align: center;
            }
            #startTimer {
                font-size: 40px; 
                font-weight: bold;
                color: white;
                margin: 2px auto;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            #timer {
                font-size: 40px; 
                font-weight: bold;
                color: white;
                margin: 2px auto;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .animated {
                animation: moveUpDown 3s infinite alternate;
            }

            @keyframes moveUpDown {
                0% {
                    top: 0px;
                }
                100% {
                    top: -30px; 
                }
            }
            
            #zenKo {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div id="centerDiv" class="row">
                <div class="col">
                    <img class="img-responsive zenko" id="zenKo" src="ZenKo.png">
                </div>
                <div class="col">
                    <div class="circle">
                        <p id="startTimer" class="text-center">START</p> 
                        <script>
                            var timer;
                            var startTime;
                            var elapsedTime = 0.0;
                            var rainCounter = false;
                            var birdCounter = false;
                            var fireCounter = false;
                            $('.circle').click(function() {
                                if (!timer) {
                                    $('#zenKo').addClass('animated');
                                    let audio1 = $('#rainAudio')[0]; 
                                    let audio2 = $('#birdAudio')[0]; 
                                    let audio3 = $('#fireAudio')[0];
                                    startTime = Date.now();
                                    console.log(startTime);
                                    elapsedTime = 0.0;
                                    console.log(elapsedTime);
                                    timer = setInterval(updateTimer, 1000);
                                    if(rainCounter) {
                                        $('#rainSpeakerButton').css('visibility','visible');
                                        audio1.play();
                                    }
                                    if(birdCounter) {
                                        $('#birdSpeakerButton').css('visibility','visible');
                                        audio2.play();
                                    }
                                    if(fireCounter) {
                                        $('#fireSpeakerButton').css('visibility','visible');
                                        audio3.play();
                                    }
                                } 
                                else {
                                    let audio1 = $('#rainAudio')[0]; 
                                    let audio2 = $('#birdAudio')[0]; 
                                    let audio3 = $('#fireAudio')[0];
                                    clearInterval(timer);
                                    timer = null;
                                    $('#zenKo').removeClass('animated');
                                    elapsedTime = ((Date.now() - startTime) / 1000 / 60); //storing in minutes
                                    console.log(elapsedTime);
                                    var postQuery = {
                                        Page: 'MainPage',
                                        Command: 'UpdateDailyProgress',
                                        TimeSpentMeditating:elapsedTime
                                    };

                                    $.post('controller_zengrove.php', postQuery, function(response) {
                                        $('.progress-bar').css('width', response);
                                        $('.progress-bar').html(response + '%');

                                        if ($('.progress-bar').html() == '100%') {
                                            $('.progress-bar').css('background-color', '#355938');
                                            $('.progress-bar').css('color', '#eee');
                                        }
                                    });

                                    if(rainCounter) {
                                        $('#rainSpeakerButton').css('visibility','hidden');
                                        audio1.pause();
                                        rainCounter = true;     
                                    }
                                    if(birdCounter) {
                                        $('#birdSpeakerButton').css('visibility','hidden');
                                        audio2.pause();
                                        birdCounter = true;
                                    }
                                    if(fireCounter) {
                                        $('#fireSpeakerButton').css('visibility','hidden');
                                        audio3.pause();
                                        fireCounter = true;
                                    }
                                    function changeText() {
                                        $('#startTimer').text('START');
                                    }
                                    setTimeout(changeText, 500);
                                }
                                console.log("Rain Counter = ",rainCounter);
                                console.log("Bird Counter = ",birdCounter);
                                console.log("Fire Counter = ",fireCounter);
                            });
                            function updateTimer() {
                                const elapsedTime = Math.floor((Date.now() - startTime) / 1000);
                                $('#startTimer').text(formatTime(elapsedTime));
                            }
                            function formatTime(seconds) {
                                const hours = Math.floor(seconds / 3600);
                                const minutes = Math.floor((seconds % 3600) / 60);
                                const remainingSeconds = seconds % 60;
                                const formattedMinutes = (minutes < 10 ? '0' : '') + minutes.toFixed(0);
                                const formattedSeconds = (remainingSeconds < 10 ? '0' : '') + remainingSeconds;
                                return `${formattedMinutes}:${formattedSeconds}`;
                            }
                        </script>
                    </div>
                </div>  
                <div class="col">
                    <p id="headerText">How to Meditate?</p>
                    <p id="text">To meditate, find a quiet space, sit comfortably, and close your eyes. 
                        Focus on your breath or a chosen mantra. When thoughts arise, acknowledge them without 
                        judgment and return your focus to your breath or mantra. Start with a few minutes daily and gradually increase.
                        You can also enhance your meditation with soothing sounds by clicking on them. 
                    </p>
                </div>
            </div>
            <div id="bottomDiv" class="row">
                <div class="col">
                    <div id="rainSound" class="soundButton">
                        <div>
                            <p class="buttonSound">Dreamy Rain
                                <img src="Speaker.png" id="rainSpeakerButton" class="img-fluid speakerButton">
                                <audio loop id="rainAudio" src="Rain.mp3" ></audio>
                            </p>   
                        </div>
                        <script>
                            $('#rainSound').click(function() {
                                let audio1 = $('#rainAudio')[0]; 
                                let audio2 = $('#birdAudio')[0]; 
                                let audio3 = $('#fireAudio')[0]; 
                                if(audio2.play) {
                                    birdCounter = false;
                                    $('#birdSpeakerButton').css('visibility','hidden');
                                    audio2.pause();
                                }
                                if(audio3.play) {
                                    fireCounter = false;
                                    $('#fireSpeakerButton').css('visibility','hidden');
                                    audio3.pause();
                                }

                                if (audio1.paused) {
                                    $('#rainSpeakerButton').css('visibility','visible');
                                    audio1.play();
                                    rainCounter = true;
                                } 
                                else {
                                    $('#rainSpeakerButton').css('visibility','hidden');
                                    audio1.pause();
                                    rainCounter = false;
                                }
                                console.log("Rain Counter = ",rainCounter);
                                console.log("Bird Counter = ",birdCounter);
                                console.log("Fire Counter = ",fireCounter);
                            });
                        </script>
                    </div>
                </div>
                <div class="col">
                <div id="birdSound" class="soundButton">
                        <div>
                            <p class="buttonSound">Chirpy Birds
                                <img src="Speaker.png" id="birdSpeakerButton" class="img-fluid speakerButton">
                                <audio loop id="birdAudio" src="Birds.mp3"></audio>
                            </p>   
                        </div>
                        <script>
                            $('#birdSound').click(function() {
                                let audio1 = $('#rainAudio')[0]; 
                                let audio2 = $('#birdAudio')[0]; 
                                let audio3 = $('#fireAudio')[0]; 
                                if(audio1.play) {
                                    rainCounter = false;
                                    $('#rainSpeakerButton').css('visibility','hidden');
                                    audio1.pause();
                                }
                                if(audio3.play) {
                                    fireCounter = false;
                                    $('#fireSpeakerButton').css('visibility','hidden');
                                    audio3.pause();
                                }

                                if (audio2.paused) {
                                    $('#birdSpeakerButton').css('visibility','visible');
                                    audio2.play();
                                    birdCounter = true;
                                } 
                                else { 
                                    $('#birdSpeakerButton').css('visibility','hidden');
                                    audio2.pause();
                                    birdCounter = false;
                                }
                                console.log("Rain Counter = ",rainCounter);
                                console.log("Bird Counter = ",birdCounter);
                                console.log("Fire Counter = ",fireCounter);
                            });
                        </script>
                    </div>
                </div>
                <div class="col">
                <div id="fireSound" class="soundButton">
                        <div>
                            <p class="buttonSound">Fierce Fire
                                <img src="Speaker.png" id="fireSpeakerButton" class="img-fluid speakerButton">
                                <audio loop id="fireAudio" src="Fire.mp3"></audio>
                            </p>   
                        </div>
                        <script>
                            $('#fireSound').click(function() {
                                let audio1 = $('#rainAudio')[0]; 
                                let audio2 = $('#birdAudio')[0]; 
                                let audio3 = $('#fireAudio')[0]; 
                                if(audio1.play) {
                                    rainCounter = false;
                                    $('#rainSpeakerButton').css('visibility','hidden');
                                    audio1.pause();
                                }
                                if(audio2.play) {
                                    birdCounter = false;
                                    $('#birdSpeakerButton').css('visibility','hidden');
                                    audio2.pause();
                                }

                                if (audio3.paused) {
                                    $('#fireSpeakerButton').css('visibility','visible');
                                    audio3.play();
                                    fireCounter = true;
                                } 
                                else {                            
                                    $('#fireSpeakerButton').css('visibility','hidden');
                                    audio3.pause();
                                    fireCounter = false;
                                }
                                console.log("Rain Counter = ",rainCounter);
                                console.log("Bird Counter = ",birdCounter);
                                console.log("Fire Counter = ",fireCounter);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
