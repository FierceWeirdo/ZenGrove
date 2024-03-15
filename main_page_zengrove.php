<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400&display=swap">
        <style>
            body {
                background-color: #99C2C5;
                font-family: 'Quicksand';
                color: #32696D;
            }
            .row {
                margin: 50px;
                padding: 5px;
                width: 800px;
            }
            .zenko {
                height: 250px;
                width: 250px;
            }
            .circle {
                width: 250px;
                height: 250px; 
                background-color: #32696D; 
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .circle:hover {
                box-shadow: 0 0 15px #064348;
            }
            .soundButton {
                background-color: #32696D;
                border-radius: 10px;
                visibility: hidden;
            }
            .soundButton:hover {
                box-shadow: 3px 3px 5px #064348;
            }
            .buttonSound {
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
                width: 400px;
                margin-left: auto;
                margin-right: auto;
            }
            #text {
                font-size: 20px; 
                text-align: left;
                display: flex;
                align-items: center;
                justify-content: left;
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
        </style>
    </head>
    <body>
        <div class=container">
            <div id="centerDiv" class="row">
                <div class="col">
                    <img class="img-responsive zenko" src="ZenKo.png">
                </div>
                <div class="col">
                    <div class="circle">
                        <p id="startTimer" class="text-center">START</p> 
                        <script>
                            $('#startTimer').click(function() {
                                $('#rainSound').css('visibility','visible');
                                $('#birdSound').css('visibility','visible');
                                $('#fireSound').css('visibility','visible');
                            });
                        </script>
                    </div>
                </div>  
                <div class="col" id="text">
                    <p>Breath Deep...</p>
                </div>
            </div>
            <div id="bottomDiv" class="row">
                <div class="col">
                    <div id="rainSound" class="soundButton">
                        <div>
                            <p class="buttonSound">Rain
                                <img src="Speaker.png" id="rainSpeakerButton" class="img-fluid speakerButton">
                                <audio loop id="rainAudio" src="Rain.mp3" ></audio>
                            </p>   
                        </div>
                        <script>
                            $('#rainSound').click(function() {
                                var audio1 = $('#rainAudio')[0]; 
                                var audio2 = $('#birdAudio')[0]; 
                                var audio3 = $('#fireAudio')[0]; 
                                if(audio2.play) {
                                    $('#birdSpeakerButton').css('visibility','hidden');
                                    audio2.pause();
                                }
                                if(audio3.play) {
                                    $('#fireSpeakerButton').css('visibility','hidden');
                                    audio3.pause();
                                }

                                if (audio1.paused) {
                                    $('#rainSpeakerButton').css('visibility','visible');
                                    audio1.play();
                                } else {
                                    $('#rainSpeakerButton').css('visibility','hidden');
                                    audio1.pause();
                                }
                            });
                        </script>
                    </div>
                </div>
                <div class="col">
                <div id="birdSound" class="soundButton">
                        <div>
                            <p class="buttonSound">Bird
                                <img src="Speaker.png" id="birdSpeakerButton" class="img-fluid speakerButton">
                                <audio loop id="birdAudio" src="Birds.mp3"></audio>
                            </p>   
                        </div>
                        <script>
                            $('#birdSound').click(function() {
                                var audio1 = $('#rainAudio')[0]; 
                                var audio2 = $('#birdAudio')[0]; 
                                var audio3 = $('#fireAudio')[0]; 
                                if(audio1.play) {
                                    $('#rainSpeakerButton').css('visibility','hidden');
                                    audio1.pause();
                                }
                                if(audio3.play) {
                                    $('#fireSpeakerButton').css('visibility','hidden');
                                    audio3.pause();
                                }

                                if (audio2.paused) {
                                    $('#birdSpeakerButton').css('visibility','visible');
                                    audio2.play();
                                } else {
                                    $('#birdSpeakerButton').css('visibility','hidden');
                                    audio2.pause();
                                }
                            });
                        </script>
                    </div>
                </div>
                <div class="col">
                <div id="fireSound" class="soundButton">
                        <div>
                            <p class="buttonSound">Fire
                                <img src="Speaker.png" id="fireSpeakerButton" class="img-fluid speakerButton">
                                <audio loop id="fireAudio" src="Fire.mp3"></audio>
                            </p>   
                        </div>
                        <script>
                            $('#fireSound').click(function() {
                                var audio1 = $('#rainAudio')[0]; 
                                var audio2 = $('#birdAudio')[0]; 
                                var audio3 = $('#fireAudio')[0]; 
                                if(audio1.play) {
                                    $('#rainSpeakerButton').css('visibility','hidden');
                                    audio1.pause();
                                }
                                if(audio2.play) {
                                    $('#birdSpeakerButton').css('visibility','hidden');
                                    audio2.pause();
                                }

                                if (audio3.paused) {
                                    $('#fireSpeakerButton').css('visibility','visible');
                                    audio3.play();
                                } else {
                                    $('#fireSpeakerButton').css('visibility','hidden');
                                    audio3.pause();
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

