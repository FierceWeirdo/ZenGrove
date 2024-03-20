<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile | ZenGrove</title>
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
                margin: 20px 100px;
                padding: 30px;
                background-color: #32696D;
                border-radius: 20px;
                height: 70vh;
                color: #99C2C5;
                position: relative;
                font-size: 20px;
            }

            #bodyHeading{
                font-size: 30px;
                text-decoration: underline;
                font-weight: 900;
            }

            #deleteProfile{
                width: max-content;
                position: absolute;
                bottom: 30px;
                left: 30px;
                padding-left: 20px;
                padding-right: 20px;
            }

            .profileValueDisplays{
                width: 100%;
                padding: 10px 15px;
                background-color: #99C2C5;
                color: #293434;
                border-radius: 20px;
            }

            .profileValueChangeButtons{
                text-align: center;
                width: 100%;
                padding: 10px;
                background-color: #99C2C5;
                color: #293434;
                border-radius: 20px;
                font-weight: 900;
                box-shadow: 5px 10px 8px #064348;
                &:hover{
                    cursor: pointer;
                    border: 1px solid #99C2C5;
                    background-color: #064348;
                    color: #99C2C5;
                    padding: 9px;
                }
            }

            #zenKo{
                position: absolute;
                bottom: 10px;
                right: 10px;
            }

            .userValues {
                color: #32696D;
                display: inline;
                font-weight: 900;
            }

            #mainBody .row {
                margin: 25px 0px;
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
                color: #293434; /* Example text color */
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

            .modal-footer .btn-secondary {
                color: white; /* Change text color */
                background-color: #32696D; /* Change background color */
                border-color: #99C2C5; /* Change border color */
            }

            /* Adjust hover color */
            .modal-footer .btn-secondary:hover {
                color: #293434; /* Change hover text color */
                background-color: #99C2C5; /* Change hover background color */
                border-color: #32696D; /* Change hover border color */
            }

            .modal-footer .btn-primary {
                color: #293434; /* Change hover text color */
                background-color: #99C2C5; /* Change hover background color */
                border-color: #32696D; /* Change hover border color */
                font-weight: 900;
            }

            /* Adjust hover color */
            .modal-footer .btn-primary:hover {
               
                color: white; /* Change text color */
                background-color: #32696D; /* Change background color */
                border-color: #99C2C5; /* Change border color */
            }

        </style>
    </head>
    <body>
        <div id="mainBody">
            <p id="bodyHeading">My Profile</p>
            <div class="container" id = >
                <div class = "row">
                    <div class="col-sm-4">
                        <div class = 'profileValueDisplays'>
                            Username: <span id='username' class="userValues"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div id="changeUsernameButton" class="profileValueChangeButtons">
                            Change Username
                        </div>
                    </div>
                </div>

                <div class = "row">
                    <div class="col-sm-4">
                        <div class="profileValueDisplays">
                            Daily Goal: <span id='dailyGoal' class="userValues"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div id="changeDailyGoalButton" class="profileValueChangeButtons">
                            Change Daily Goal
                        </div>
                    </div>
                </div>

                <div class = "row">
                    <div class="col-sm-5">
                        <div class="profileValueDisplays">
                            Total Medals of Achievement: <span id='zenMedals' class="userValues"></span> <img src="ZenMedal.png" width=20px>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profileValueChangeButtons" id="deleteProfile">
                Delete Profile
            </div>

            <img src="ZenKo.png" width = 180px id="zenKo">

        <!-- Delete Profile Modal -->
        <script>
            $('#deleteProfile').click(function(){
                $('#deleteProfileModal').modal('show');
            });
        </script>
        <div class="modal fade" id="deleteProfileModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    Are you sure you want to delete your account? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Username -->
        <script>
            $('#changeUsernameButton').click(function(){
                $('#changeUsernameModal').modal('show');
            });
        </script>
        <div class="modal fade" id="changeUsernameModal" tabindex="-1" role="dialog" aria-labelledby="changeUsernameModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="changeUsernameModalLabel">Change Username</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controller_zengrove.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                        <input type="hidden" name="Page" value="MyProfile">
                        <input type="hidden" name="Command" value="ChangeUsername">
                        <label for="newUsername">New Username:</label>
                        <input type="text" class="form-control" id="newUsername" name='newUsername' placeholder="Enter new username">
                        </div>
                    </div> 
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              </div>
            </div>
          </div>


          <!-- Change Daily Goal -->
        <script>
            $('#changeDailyGoalButton').click(function(){
                $('#setGoalTimeModal').modal('show');
            });
        </script>
        <div class="modal fade" id="setGoalTimeModal" tabindex="-1" role="dialog" aria-labelledby="setGoalTimeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="setGoalTimeModalLabel">Set Daily Goal Time</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controller_zengrove.php" method="POST">
                    <div class="modal-body">
                    <input type="hidden" name="Page" value="MyProfile">
                        <input type="hidden" name="Command" value="ChangeDailyGoal">
                        <div class="form-group">
                        <label for="dailyGoalTime">Enter Daily Goal Time (in minutes)</label>
                        <input type="number" class="form-control" id="dailyGoalTime" name="newDailyGoal" placeholder="Enter daily goal time" min="0" max="1440" required>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <script>
             $(document).ready(function() {
                    // Create a new XMLHttpRequest object
                    var xhr = new XMLHttpRequest();

                    // Define the function to handle the response
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Parse JSON response
                                var data = JSON.parse(xhr.responseText);

                                // Update HTML elements with the retrieved values
                                document.getElementById('username').innerText = data.username;
                                document.getElementById('dailyGoal').innerText = data.daily_goal;
                                document.getElementById('zenMedals').innerText = data.zen_medals;
                            } else {
                                console.error('Error fetching user profile. Status:', xhr.status);
                            }
                        }
                    };

                    // Open a new POST request to the server
                    xhr.open('POST', 'controller_zengrove.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    // Prepare the data to be sent
                    var formData = 'Page=MyProfile&Command=GetUserProfile';

                    // Send the request with the data
                    xhr.send(formData);                                    
                });

          </script>
    </body>
</html>