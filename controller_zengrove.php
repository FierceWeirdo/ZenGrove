<?php
include('model_zengrove.php');
session_start(); 
if(!isset($_POST['Page'])){
    include("welcome_page_zengrove.php");
}
else{
    $page = $_POST['Page'];
    $command = $_POST['Command'];
    switch ($command){
        case 'ShowHomePage':
            include("home_page_zengrove.php");
            break;
        case 'ShowMyZenMates':
            include("my_zenmates_zengrove.php");
            break;
        case 'ShowMyProfile':
            include("my_profile_zengrove.php");
            break;
    }

    if($page == 'WelcomePage'){
        switch($command){
            case 'LogIn':
                $username = $_POST['username'];
                $password = $_POST['password'];
                if(areCredentialsValid($username, $password)){
                    $id = getUserId($username)['Id'];
                    $_SESSION['UserId'] = $id;
                    include("main_page_zengrove.php");
                    echo "<script>console.log($id); </script>";
                }
                else{
                    include("welcome_page_zengrove.php");
                    echo "<script>alert('Incorrect Credentials! Try again!');</script>";
                }
                break;
            case 'SignUp':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                if(!doesUserAlreadyExist($username)){
                    if(insertUserIntoTable($username, $password, $email)){
                        $id = getUserId($username)['Id'];
                        $_SESSION['UserId'] = $id;
                        include("main_page_zengrove.php");
                    }
                    else{
                        include("welcome_page_zengrove.php");
                        echo "<script>alert('Sign Up Failed! Try again!');</script>";
                    }
                }
                else{
                    include("welcome_page_zengrove.php");
                    echo "<script>alert('Username is already taken!');</script>";
                }
                break;
        }
    }
    else if ($page == 'MyProfile') {
        switch($command) {
            case 'GetUserProfile':
                $id = $_SESSION['UserId'];
                $profileArr = getUserProfile($id);
                if ($profileArr) {
                    $profileUsername = $profileArr['Username'];
                    $profileDailyGoal = $profileArr['DailyGoal'];
                    $profileZenMedals = $profileArr['ZenMedals'];

                    $response = array(
                        'username' => $profileUsername,
                        'daily_goal' => $profileDailyGoal,
                        'zen_medals' => $profileZenMedals
                    );
    
                    $jsonResponse = json_encode($response);

                    echo $jsonResponse;
                }
                break;
            case 'ChangeUsername':
                $id = $_SESSION['UserId'];
                $newUsername = $_POST['newUsername'];
                if(!doesUserAlreadyExist($newUsername)){
                    updateUsername($id, $newUsername);
                    echo "<script>alert('Username updated!');</script>";
                    include('main_page_zengrove.php');
                }
                else{
                    echo "<script>alert('Username already taken!');</script>";
                    include('main_page_zengrove.php');
                }
                break;
            case 'ChangeDailyGoal':
                $id = $_SESSION['UserId'];
                $newDailyGoal = $_POST['newDailyGoal'];
                updateDailyGoal($id, $newDailyGoal);
                echo "<script>alert('Daily Goal updated!');</script>";
                include('main_page_zengrove.php');
                break;
            case 'LogOut':
                session_unset();
                session_destroy();
                include('welcome_page_zengrove.php');
                break;
        }
    }
    else if ($page == 'MainPage'){
        switch($command){
            case 'GetDailyProgress':
                $id = $_SESSION['UserId'];
                $lastMeditatedTodayBool = checkUserActivityDate($id);
                if($lastMeditatedTodayBool){
                    $progress = getUserProfile($id)['DailyProgress'];
                } else {
                    $progress = 0;
                    updateDailyProgress($id, 0);
                }

                echo $progress;
                break;
            case 'UpdateDailyProgress':
                $id = $_SESSION['UserId'];
                $time = $_POST['TimeSpentMeditating'];
                updateDailyProgress($id, $time);
                $progress = getUserProfile($id)['DailyProgress'];
                echo $progress;
                break;
        }
    }
    else if($page == 'MyZenMates'){
        switch ($command){
            case 'GetAllZenMates':
                $id = $_SESSION['UserId'];
                $arrayOfZenMates = getAllZenMatesUsernames($id);
                if (!empty($arrayOfZenMates)) {
                    $str = '';
                    foreach ($arrayOfZenMates as $zenMate) {
                        $str .= "<tr><td>$zenMate</td></tr>";
                    }
                    echo $str;
                } else {
                    echo "No Zen Mates found";
                }
                break;
            case 'GetUserProfile':
                break;
        }
    }
}

?>