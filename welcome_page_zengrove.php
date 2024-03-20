<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to ZenGrove</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="styling_zengrove.css">
        <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
        <style> 
            #mainBody {
                padding: 30px;
                text-align: center;
                vertical-align: center;
                height: 100vh;
            }

            #welcomeDiv {
                background-color: #32696D;
                color: #99C2C5;
                font-size: 40px;
                padding: 10px;
                /* top right bottom left */
                margin: 0px 10px 40px 10px;
                border-radius: 20px;
                height: 25vh;
                display: grid;
                place-items: center;
            }

            #logInButton, #signUpButton {
                padding: 20px;
                /* Top-bottom right-left */
                margin: 20px 30%;
                background-color: #ccc;
                border-radius: 20px;
                height: 15vh;
                background-color: #32696D;
                color: #99C2C5;
                display: grid;
                place-items: center;
                &:hover{
                    cursor: pointer;
                    box-shadow: 5px 10px 8px #064348;
                    background-color: #99C2C5;
                    color: #32696D;
                    border: 2px solid #32696D;
                }
                transition: 0.3s background-color;
            }


            #leftDiv{
                background-color: #32696D;
                margin:0 20px;
                height: 90vh;
                border-radius: 20px;
                color: #99C2C5;
                display: grid;
                place-items: center;
                font-weight: 600;
            }

            #rightDiv {
                margin-top: 10px;
                font-weight: 900;
            }

            #rightDiv > p {
                font-size: 20px;
                color: #32696D;
                font-weight: 400;
            }

            .modal-content {
                background-color: #32696D; /* Example background color */
                border: 2px solid #99C2C5;
                color: #99C2C5;
            }

            /* Customize input fields */
            .modal-body input[type="text"],
            .modal-body input[type="password"],
            .modal-body input[type="email"],
            .modal-body button[type="submit"] {
                background-color: #99C2C5; /* Example input background color */
                color: #000000; /* Example text color */
                border: 1px solid #99C2C5;
            }

            .close::before {
                content: "";
                position: absolute;
                top: 19px;
                right: 12px;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background-color: #99C2C5;
                z-index: -1; 
            }

            .close {
                color: #32696D; 
                box-shadow: none;
            }

            #login, #signUp{
                background-color: #32696D; 
                border: 2px solid #99C2C5;
                color: #99C2C5;
            }

            #login:hover, #signUp:hover{
                background-color: #99C2C5; 
                border: 2px solid #99C2C5;
                color: #32696D;
            }

        </style>
    </head>
    <body>
        <div class="container-fluid" id='mainBody'>
            <div class="row">
                <div class="col-md-4">
                    <div id="leftDiv">
                        <br>
                        <img src="ZenKo.png" width="60%">
                        <p>
                            Meditate <br>
                            Build a ZenCommunity <br>
                            Win ZenMedals <br>
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="rightDiv">
                        <div id="welcomeDiv">Welcome to ZenGrove</div>
                        <p> Already have an account? </p>
                        <div id="logInButton">LOG IN</div>
                        <p> New to ZenGrove? Create a new account! </p>
                        <div id="signUpButton">SIGN UP</div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Login Modal -->
        <div class="modal fade" id="loginModal" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <!-- Login form goes here -->
                <form action="controller_zengrove.php" method="POST">
                    <div class="form-group">
                    <input type="hidden" name="Page" value="WelcomePage">
                    <input type="hidden" name="Command" value="LogIn">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary" id="login">Login</button>
                    <?php 
                        if(isset($_SESSION['LoginError']) && $_SESSION['LoginError']) {
                            echo "<script>  $('#loginModal').modal('show'); </script> <span style='font-size: 18px; color: white; font-style: italic; '>Incorrect credentials! Please try again.</span>";
                            unset($_SESSION['LoginError']);
                        }
                    ?>
                </form>
                </div>
            </div>
            </div>
        </div>
        
        <script>
            $("#logInButton").click(function (){
                $('#loginModal').modal('show');
            })
        </script>

        <!-- Sign Up Modal -->
        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <!-- Sign up form goes here -->
                <form action="controller_zengrove.php" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="Page" value="WelcomePage">
                        <input type="hidden" name="Command" value="SignUp">
                        <label for="signUpUsername">Username</label>
                        <input type="text" class="form-control" id="signUpUsername" name="username" placeholder="Enter a username">
                    </div>
                    <div class="form-group">
                        <label for="SignUpPassword">Password</label>
                        <input type="password" class="form-control" id="SignUpPassword" name="password" placeholder="Enter a password">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <button type="submit" id="signUp" class="btn btn-primary">Sign Up</button>
                    <?php 
                        if(isset($_SESSION['SignUpError']) && $_SESSION['SignUpError']) {
                            echo "<script>  $('#signupModal').modal('show'); </script> <span style='font-size: 18px; color: white; font-style: italic;'>Username already exists!</span>";
                            unset($_SESSION['SignUpError']);
                        }
                        ?>
                </form>
                </div>
            </div>
            </div>
        </div>
        
        <script>
            $("#signUpButton").click(function (){
                $('#signupModal').modal('show');
            })
        </script>

    </body>
</html>