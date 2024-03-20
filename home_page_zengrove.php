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
                width: 45%;
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
        </style>
    </head>
    <body>
        <div class="container">
            <div id="centerDiv" class="row">
                <div class="col">
                    <img class="img-responsive zenko" src="ZenKo.png">
                </div>
                <div class="col">
                    <div class="circle">
                        <p id="startTimer" class="text-center">START</p> 
                        <script>
                            let timer;
                            let startTime;
                            let rainCounter = false;
                            let birdCounter = false;
                            let fireCounter = false;
                            $('.circle').click(function() {
                                if (!timer) {
                                    let audio1 = $('#rainAudio')[0]; 
                                    let audio2 = $('#birdAudio')[0]; 
                                    let audio3 = $('#fireAudio')[0];
                                    startTime = Date.now();
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
                                    setTimeout(changeText, 2000);
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
